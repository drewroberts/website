<?php

declare(strict_types=1);

namespace Tipoff\Support\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

abstract class BaseApiRequest extends FormRequest
{
    // Default page size in API pagination.
    const PAGE_SIZE = 20;

    /**
     * Cached model.
     *
     * @var object
     */
    protected $model;

    abstract public function getModelClass(): string;

    /**
     * Get model related with request basing on children getModelClass method.
     *
     * If possible resolve it.
     */
    public function getModel(): object
    {
        if (empty($this->model)) {
            $model = app($this->getModelClass());

            $parameter = $this
                ->route()
                ->parameter(
                    Str::singular($model->getTable())
                );
            if (is_object($parameter) && $this->getModelClass() == get_class($parameter)) {
                $model = $parameter;
            }
            $this->model = $model;
        }

        return $this->model;
    }

    /**
     * Get base name of model class.
     */
    public function getModelClassBasename(): string
    {
        $baseName = class_basename($this->getModelClass());

        return strtolower($baseName);
    }

    /**
     * Get fillable fields of model.
     */
    public function getFillable(): array
    {
        return $this->getModel()->getFillable();
    }

    /**
     * Check if user is authorized to perform action.
     */
    public function authorizeAction(string $action): bool
    {
        $user = $this->user();
        // $policy = Gate::getPolicyFor($this->getModel());

        switch ($action) {
            case 'viewAny':
            case 'create':
                return $user->can($action, $this->getModel());
            default:
                return $user->can($action, $this->getModel());
        }
    }

    /**
     * Get pagination size.
     */
    public function getPageSize(): int
    {
        if ($this->has('page.size')) {
            return $this->input('page.size');
        }

        return self::PAGE_SIZE;
    }
}
