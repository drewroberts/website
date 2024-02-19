<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Tipoff\Addresses\Transformers\RegionTransformer;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

/**
 * Class Region
 * @package Tipoff\Addresses\Models
 */
class Region extends BaseModel
{
    use HasPackageFactory;

    /**
     * @var array
     */
    protected $casts = [];

    /**
     * boots model
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($region) {
            if (empty($region->name)) {
                throw new \Exception('A region must have a name.');
            }
            if (empty($region->slug)) {
                throw new \Exception('A region must have a slug.');
            }
        });
    }

    public function getTransformer($context = null)
    {
        return new RegionTransformer();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zips()
    {
        return $this->hasMany(app('zip'));
    }
}
