<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

use Illuminate\Database\Eloquent\Builder;
use Tipoff\Support\Transformers\BaseTransformer;

interface BaseModelInterface
{
    /**
     * Using docblock typehints to allow implementing classes freedom
     * to include docblock with class specific type
     *
     * @param mixed $id
     * @return self|null
     */
    public static function find($id);

    /**
     * @param mixed $id
     * @return self
     */
    public static function findOrFail($id);

    /**
     * Return transformer instance for model, or null if transformation not supported.
     *
     * @param mixed|null $context
     * @return BaseTransformer|null
     */
    public function getTransformer($context = null);

    /**
     * Get default view component for model, or null if not supported.  Can be helpful
     * for dynamic component rendering.
     *
     * @param mixed|null $context
     * @return string|null
     */
    public function getViewComponent($context = null);

    /**
     * @return mixed|null
     */
    public function getId();

    /**
     * Determine if User owns this resource
     *
     * @param UserInterface $user
     * @return bool
     */
    public function isOwner(UserInterface $user): bool;

    /**
     * Scope results to only those that given user should have access to.
     *
     * @param Builder $query
     * @param UserInterface $user
     * @return Builder
     */
    public function scopeVisibleBy(Builder $query, UserInterface $user): Builder;
}
