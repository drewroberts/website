<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class CountryCallingcode extends BaseModel
{
    use HasPackageFactory;

    protected $casts = [];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($countryCallingcode) {
            if (empty($countryCallingcode->code)) {
                throw new \Exception('A country calling code must have a code.');
            }
            $countryCallingcode->root = "+".substr($countryCallingcode->code, 0, 1);
            $countryCallingcode->suffix = substr($countryCallingcode->code, 1);
        });
    }

    public function country()
    {
        return $this->belongsTo(app('country'));
    }

    public function phones()
    {
        return $this->hasMany(app('phone'));
    }
}
