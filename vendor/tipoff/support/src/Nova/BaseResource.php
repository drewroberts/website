<?php

declare(strict_types=1);

namespace Tipoff\Support\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

abstract class BaseResource extends NovaResource
{
    protected array $filterClassList = [];

    protected array $cardClassList = [];

    protected array $lensClassList = [];

    protected array $actionClassList = [];

    /**
     * @return array|Field[]
     */
    protected function dataFields(): array
    {
        return [
            ID::make(),
        ];
    }

    /**
     * @return array|Field[]
     */
    protected function creatorDataFields(): array
    {
        $userResource = nova('user');

        return $userResource ? [
            BelongsTo::make('Created By', 'creator', $userResource)->exceptOnForms(),
            DateTime::make('Created At')->exceptOnForms(),
        ] : [];
    }

    /**
     * @return array|Field[]
     */
    protected function updaterDataFields(): array
    {
        $userResource = nova('user');

        return $userResource ? [
            BelongsTo::make('Updated By', 'updater', $userResource)->exceptOnForms(),
            DateTime::make('Updated At')->exceptOnForms(),
        ] : [];
    }

    public function cards(Request $request)
    {
        return $this->processClasses($this->cardClassList);
    }

    public function filters(Request $request)
    {
        return $this->processClasses($this->filterClassList);
    }

    public function lenses(Request $request)
    {
        return $this->processClasses($this->lensClassList);
    }

    public function actions(Request $request)
    {
        return $this->processClasses($this->actionClassList);
    }

    private function processClasses(array $classes): array
    {
        // Filter classes requested to those that actually exist
        // and return map class to instantiated instance
        return array_map(
            function (string $class) {
                return new $class;
            },
            array_filter($classes, function (string $class) {
                return class_exists($class);
            })
        );
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a Scout search query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @psalm-suppress UndefinedDocblockClass
     * @param  \Laravel\Scout\Builder  $query
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "detail" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query);
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        return parent::relatableQuery($request, $query);
    }

    // https://github.com/laravel/nova-issues/issues/156#issuecomment-456751499
    protected static function applyOrderings($query, array $orderings)
    {
        if (empty($orderings) && property_exists(static::class, 'orderBy')) {
            /** @psalm-suppress UndefinedPropertyFetch */
            $orderings = static::$orderBy;
        }

        return parent::applyOrderings($query, $orderings);
    }

    // https://github.com/laravel/nova-issues/issues/58#issuecomment-533821333

    /**
     * Creates and returns a fresh instance of the model represented by the resource.
     *
     * @return mixed
     */
    public static function newModel()
    {
        /** @psalm-suppress UndefinedPropertyFetch */
        $model = static::$model;

        $instance = new $model;

        $instance->setRawAttributes(static::getDefaultAttributes());

        return $instance;
    }

    /**
     * Returns the default attributes for new model instances.
     *
     * @return array
     */
    public static function getDefaultAttributes()
    {
        return static::$defaultAttributes ?? [];
    }
}
