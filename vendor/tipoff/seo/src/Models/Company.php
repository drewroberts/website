<?php

declare(strict_types=1);

namespace Tipoff\Seo\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Company extends BaseModel
{
    use HasPackageFactory;
    use HasCreator;
    use HasUpdater;

    public function users()
    {
        return $this->belongsToMany(app('user'))->withTimestamps()->withPivot(['creator_id', 'updater_id', 'primary_contact'])->using(CompanyUser::class);
    }

    public function domains()
    {
        return $this->hasMany(app('domain'));
    }

    public function places()
    {
        return $this->hasMany(app('place'));
    }

    /**
     * @codeCoverageIgnore
     */
    public function locations()
    {
        return $this->hasMany(app('location'));
    }

    public function domestic_address()
    {
        return $this->belongsTo(app('domestic_address'));
    }

    public function phone()
    {
        return $this->belongsTo(app('phone'));
    }

    // @todo use new addresable trait
    public function address()
    {
        return $this->morphOne(app('address'), 'addressable');
    }
}
