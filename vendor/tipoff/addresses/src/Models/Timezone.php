<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Tipoff\Addresses\Transformers\TimezoneTransformer;
use Tipoff\Support\Contracts\Addresses\TimezoneInterface;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class Timezone extends BaseModel implements TimezoneInterface
{
    use HasPackageFactory;

    public $timestamps = false;

    public static function fromAbbreviation(string $timezone_name): self
    {
        /** @var Timezone $result */
        $result = static::query()->where('name', '=', $timezone_name)->firstOrFail();

        return $result;
    }

    public static function getNameFromPHP(string $php_timezone): string
    {
        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone($php_timezone));
        $timezone = $dateTime->format('T');
        if ($timezone === 'HDT' || $timezone === 'HST') {
            return 'HAST';
        }

        return $timezone;
    }

    public function getTransformer($context = null)
    {
        return new TimezoneTransformer();
    }

    public function markets()
    {
        return $this->belongsToMany(app('market'));
    }

    public function locations()
    {
        return $this->belongsToMany(app('location'));
    }

    public function cities()
    {
        return $this->hasMany(app('city'));
    }

    public function zip()
    {
        return $this->hasMany(app('zip'));
    }

    public function getPhpTZ(): string
    {
        return $this->php;
    }
}
