<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Assert\Assert;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;

class PlaceDetails extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;

    const UPDATED_AT = null;

    protected $casts = [
        'opened_at' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($place_details) {
            Assert::lazy()
                ->that($place_details->name)->notEmpty('Place details must have a name.')
                ->that($place_details->place_id)->notEmpty('Place details must belong to a place.')
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function webpage()
    {
        return $this->belongsTo(app('webpage'));
    }
}
