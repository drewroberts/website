<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class Phone extends BaseModel
{
    use HasPackageFactory;

    protected $casts = [];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($phone) {
            if (empty($phone->full_number)) {
                throw new \Exception('A phone must have a full number.');
            }
        });
    }

    public function countryCallingcode()
    {
        return $this->belongsTo(app('country_callingcode'), 'country_callingcode_id');
    }

    public function phoneArea()
    {
        return $this->belongsTo(app('phone_area'), 'phone_area_code');
    }

    public function getFormattedNumberAttribute()
    {
        if (strlen($this->full_number ?? '') === 10) {
            return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $this->full_number);
        }
    }

    public function getParentheticalFormattedNumbersAttribute()
    {
        if (strlen($this->full_number) === 10) {
            return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $this->full_number);
        }
    }
}
