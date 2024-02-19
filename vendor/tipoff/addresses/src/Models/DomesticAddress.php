<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Assert\Assert;
use Carbon\Carbon;
use Tipoff\Addresses\Transformers\DomesticAddressTransformer;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

/**
 * @property int id
 * @property string address_line_1
 * @property string address_line_2
 * @property City city
 * @property Zip zip
 * @property Carbon created_at
 * @property Carbon updated_at
 * // Raw relations
 * @property int city_id
 * @property string zip_code
 */
class DomesticAddress extends BaseModel
{
    use HasPackageFactory;

    protected $casts = [
        'id' => 'integer',
        'city_id' => 'integer',
    ];

    protected $fillable = [
        'address_line_1',
        'address_line_2',
        'city_id',
        'zip_code',
    ];

    /**
     * @param string $line1
     * @param string|null $line2
     * @param string|City $city
     * @param string|Zip $zip
     * @return static
     */
    public static function createDomesticAddress(string $line1, ?string $line2, $city, $zip): self
    {
        $zip = self::resolveZip($zip);
        $city = self::resolveCity($city, $zip);

        /** @var DomesticAddress $domesticAddress */
        $domesticAddress = static::query()->firstOrCreate([
            'address_line_1' => trim($line1),
            'address_line_2' => empty($line2) ? null : trim($line2),
            'city_id' => $city->id,
            'zip_code' => $zip->code,
        ]);

        return $domesticAddress;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (DomesticAddress $address) {
            $address->zip_code = self::resolveZip($address->zip_code)->code;
            $address->city_id = self::resolveCity($address->city, $address->zip_code)->id;

            unset($address->city);

            Assert::lazy()
                ->that($address->address_line_1)->notEmpty('US domestic addresses must have a street.')
                ->that($address->city_id)->notEmpty('US domestic addresses must have a city.')
                ->that($address->zip_code)->notEmpty('US domestic addresses must have zip code.')
                ->verifyNow();
        });
    }

    /**
     * @param $zip
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Zip|null
     */
    public static function resolveZip($zip)
    {
        return ($zip instanceof Zip) ? $zip : Zip::query()->findOrFail(trim($zip));
    }

    /**
     * @param $city
     * @param $zip
     * @return City
     */
    public static function resolveCity($city, $zip): City
    {
        $zip = self::resolveZip($zip);

        return ($city instanceof City) ? $city : City::query()->byTitle($city)->byZip($zip)->firstOrCreate([
            'title' => $city,
            'state_id' => $zip->state_id,
        ]);
    }

    public function getTransformer($context = null)
    {
        return new DomesticAddressTransformer();
    }

    public function address()
    {
        return $this->morphOne(app('address'), 'addressable');
    }

    public function city()
    {
        return $this->belongsTo(app('city'));
    }

    public function zip()
    {
        return $this->belongsTo(app('zip'));
    }
}
