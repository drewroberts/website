<?php

declare(strict_types=1);

namespace Tipoff\Support\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Trait that helps implement stub models in packages to facilitate testing.
 */
trait TestModelStub
{
    use HasFactory;

    abstract public function getTable();

    public static function createTable(): void
    {
        $table = (new static)->getTable();
        if (! Schema::hasTable($table)) {
            Schema::create($table, function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }
    }

    /**
     * @inheritDoc
     */
    protected static function newFactory()
    {
        $factory = new class extends Factory {
            public function setModelNameResolver($class): self
            {
                self::$modelNameResolver = function () use ($class) {
                    return $class;
                };

                return $this;
            }

            public function definition()
            {
                return [
                ];
            }
        };

        return $factory->setModelNameResolver(static::class);
    }
}
