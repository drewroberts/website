<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Carbon\Carbon;
use Tipoff\Addresses\Transformers\StateTransformer;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

/**
 * @property int id
 * @property string slug
 * @property string title
 * @property string abbreviation
 * @property string description
 * @property string capital
 * @property Country country
 * @property Carbon created_at
 * @property Carbon updated_at
 * // Raw relations
 * @property int country_id
 */
class State extends BaseModel
{
    use HasPackageFactory;

    protected $casts = [];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($state) {
            if (empty($state->title)) {
                throw new \Exception('A state must have a title.');
            }
            if (empty($state->abbreviation)) {
                throw new \Exception('A state must have an abbreviation.');
            }
            if (empty($state->slug)) {
                throw new \Exception('A state must have a slug.');
            }
            if (empty($state->country_id)) {
                throw new \Exception('A state must belong to a country.');
            }
        });
    }

    public static function fromAbbreviation(string $abbreviation): ?self
    {
        /** @var State $result */
        try {
            $result = static::query()->where('abbreviation', '=', $abbreviation)->firstOrFail();

            return $result;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getTransformer($context = null)
    {
        return new StateTransformer();
    }

    public function country()
    {
        return $this->belongsTo(app('country'));
    }

    public function zips()
    {
        return $this->hasMany(app('zip'));
    }

    public function cities()
    {
        return $this->hasMany(app('city'));
    }

    public function phoneAreas()
    {
        return $this->hasMany(app('phone_area'), 'phone_area_code');
    }
}
