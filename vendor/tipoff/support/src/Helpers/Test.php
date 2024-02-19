<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Services\BaseService;

if (! function_exists('randomOrCreate')) {
    /**
     * Get random model or create model using factory.
     *
     * @param string|Model $classNameOrModel
     * @return Model
     * @throws Exception
     */
    function randomOrCreate($classNameOrModel): Model
    {
        if (is_string($classNameOrModel)) {
            $className = $classNameOrModel;
        }

        if ($classNameOrModel instanceof Model) {
            $className = get_class($classNameOrModel);
        }

        if (! isset($className)) {
            throw new Exception('Cannot find class for ' . $classNameOrModel);
        }

        if ($className::count() > 0) {
            return $className::all()->random();
        }

        return $className::factory()->create();
    }
}

if (! function_exists('nova')) {
    function nova(string $model): ?string
    {
        $model = preg_match('/^nova\./', $model) ? $model : 'nova.' . $model;

        $alias = app()->getAlias($model);

        if ($alias === $model) {
            // Alias has no definition
            return null;
        }

        if (! class_exists($alias)) {
            return null;
        }

        return $alias;
    }
}

if (! function_exists('morphClass')) {
    function morphClass(string $model): ?string
    {
        $alias = app()->getAlias($model);

        if ($alias === $model) {
            // Alias has no definition
            return null;
        }

        if (! class_exists($alias)) {
            return null;
        }

        return app($alias)->getMorphClass();
    }
}

if (! function_exists('findModel')) {
    /**
     * Helper to retrieve model interface by Id but only if
     * interface class has been registered.  Null if interface
     * is not registered or model is not found
     *
     * @param string $interfaceClass
     * @param mixed $id
     * @return BaseModelInterface|null
     */
    function findModel(string $interfaceClass, $id)
    {
        if (app()->has($interfaceClass)) {
            /** @var BaseModelInterface $interface */
            $interface = app($interfaceClass);

            return $interface::find($id);
        }

        return null;
    }
}

if (! function_exists('findModelOrFail')) {
    /**
     * Helper to retrieve model interface by Id but only if
     * interface class has been registered, exception if
     * not found, null if interface is not registered
     *
     * @param string $interfaceClass
     * @param mixed $id
     * @return BaseModelInterface|null
     */
    function findModelOrFail(string $interfaceClass, $id)
    {
        if (app()->has($interfaceClass)) {
            /** @var BaseModelInterface $interface */
            $interface = app($interfaceClass);

            return $interface::findOrFail($id);
        }

        return null;
    }
}

if (! function_exists('findService')) {
    /**
     * Helper to retrieve service interface if it is
     * registered, null otherwise
     *
     * @param string $interfaceClass
     * @return BaseService|null
     */
    function findService(string $serviceClass)
    {
        if (app()->has($serviceClass)) {
            return app($serviceClass);
        }

        return null;
    }
}

if (! function_exists('createModelStub')) {
    /**
     * Dynamically defines a model class on the fly if not already defined.  Useful
     * for creating stub models and there tables to satisfy possible FK dependencies.
     *
     * @param string $class
     */
    function createModelStub(string $class): void
    {
        if (class_exists($class)) {
            return;
        }

        $classBasename = class_basename($class);
        $classNamespace = substr($class, 0, strrpos($class, '\\'));

        $classDef = <<<EOT
namespace {$classNamespace};

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Models\TestModelStub;

class {$classBasename} extends BaseModel {
    use TestModelStub;
};
EOT;
        // alias the anonymous class with your class name
        eval($classDef);
    }
}

if (! function_exists('createNovaResourceStub')) {
    /**
     * Dynamically defines a Nova resource class on the fly if not already defined.  Useful
     * for creating stub resources to allow isolated testing of Nova resources in a package.
     *
     * @param string $novaClassName
     */
    function createNovaResourceStub(string $novaClass, string $modelClass): void
    {
        if (class_exists($novaClass)) {
            return;
        }

        $classBasename = class_basename($novaClass);
        $classNamespace = substr($novaClass, 0, strrpos($novaClass, '\\'));

        $classDef = <<<EOT
namespace {$classNamespace};

use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class {$classBasename} extends Resource
{
    public static \$model = \\{$modelClass}::class;

    public function fields(Request \$request)
    {
    }
}
EOT;
        // alias the anonymous class with your class name
        eval($classDef);
    }
}
