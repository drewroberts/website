<?php

declare(strict_types=1);

namespace Tipoff\Support\Models;

use Assert\Assert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Models\UserInterface;

class BaseModel extends Model implements BaseModelInterface
{
    protected $guarded = ['id'];

    /**
     * NOTE:  Override introduces extra stack frame requiring custom `guessBelongsToRelation` override.
     *
     * @inheritDoc
     */
    public function belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
    {
        if (is_string($related)) {
            Assert::that($related)->classExists();
        }

        return parent::belongsTo($related, $foreignKey, $ownerKey, $relation);
    }

    /**
     * NOTE:  Override introduces extra stack frame requiring custom `guessBelongsToRelation` override.
     *
     * @inheritDoc
     */
    public function morphTo($name = null, $type = null, $id = null, $ownerKey = null)
    {
        if (is_string($type)) {
            Assert::that($type)->classExists();
        }

        return parent::morphTo($name, $type, $id, $ownerKey);
    }

    /**
     * NOTE:  Override required to discard extra stack frame created in other overrides.
     *
     * @inheritDoc
     * @psalm-suppress UnusedVariable
     */
    protected function guessBelongsToRelation()
    {
        // Account for extra stack frame!
        [$one, $two, $three, $caller] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 4);

        return $caller['function'];
    }

    /**
     * @inheritDoc
     */
    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        if (is_string($related)) {
            Assert::that($related)->classExists();
        }

        return parent::hasMany($related, $foreignKey, $localKey);
    }

    public static function find($id)
    {
        /** @var BaseModelInterface|null $result */
        $result = static::query()->find($id);

        return $result;
    }

    public static function findOrFail($id)
    {
        /** @var BaseModelInterface $result */
        $result = static::query()->findOrFail($id);

        return $result;
    }

    public function getTransformer($context = null)
    {
        return null;
    }

    public function getViewComponent($context = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function isOwner(UserInterface $user): bool
    {
        return false;
    }

    public function scopeVisibleBy(Builder $query, UserInterface $user): Builder
    {
        return $this->scopeNeverVisible($query);
    }

    protected function scopeNeverVisible(Builder $query): Builder
    {
        return $query->whereRaw('1 = 0');
    }

    protected function scopeAlwaysVisible(Builder $query): Builder
    {
        return $query;
    }
}
