<?php

declare(strict_types=1);

namespace Tipoff\Support\Traits;

trait HasUpdater
{
    protected static function bootHasUpdater()
    {
        static::saving(function ($model) {
            if (auth()->check()) {
                $model->updater_id = auth()->id();
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updater()
    {
        return $this->belongsTo(app('user'), 'updater_id');
    }
}
