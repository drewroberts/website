<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class PhoneArea extends BaseModel
{
    use HasPackageFactory;
    
    // These 3 lines of code allow the use of a string as primary key other than ID.
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $keyType = 'integer';

    protected $casts = [];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($phoneArea) {
            if (empty($phoneArea->code)) {
                throw new \Exception('A phone area must have a code.');
            }
        });
    }

    public function state()
    {
        return $this->belongsTo(app('state'), 'state_id');
    }

    public function phones()
    {
        return $this->hasMany(app('phone'), 'phone_id', 'phone_area_code');
    }
}
