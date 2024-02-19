<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Assert\Assert;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class PlaceHours extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;
    use HasUpdater;

    const UPDATED_AT = null;

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($place_hours) {
            Assert::lazy()
                ->that($place_hours->place_id)->notEmpty('Place hours must belong to a place.')
                ->verifyNow();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(app('place'));
    }
}
