<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Tipoff\Addresses\Transformers\CountryTransformer;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class Country extends BaseModel
{
    use HasPackageFactory;

    protected $casts = [];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($country) {
            if (empty($country->slug)) {
                throw new \Exception('A country must have a slug.');
            }
            if (empty($country->title)) {
                throw new \Exception('A country must have a common name for a title.');
            }
            if (empty($country->official)) {
                throw new \Exception('A country must have an official name.');
            }
            if (empty($country->abbreviation)) {
                throw new \Exception('A country must have a 3 digit ISO 3166-1 abbreviation.');
            }
        });
    }

    public static function fromAbbreviation(string $abbreviation): self
    {
        /** @var Country $result */
        $result = static::query()->where('abbreviation', '=', $abbreviation)->firstOrFail();

        return $result;
    }

    public function getTransformer($context = null)
    {
        return new CountryTransformer();
    }

    public function states()
    {
        return $this->hasMany(app('state'));
    }

    public function callingCodes()
    {
        return $this->hasMany(app('country_callingcode'), 'country_callingcode_id');
    }
}
