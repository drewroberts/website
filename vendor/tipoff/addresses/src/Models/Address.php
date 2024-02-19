<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Assert\Assert;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Tipoff\Addresses\Transformers\AddressTransformer;
use Tipoff\Authorization\Models\User;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

/**
 * @property int id
 * @property DomesticAddress domesticAddress
 * @property Model addressable
 * @property string type
 * @property string first_name
 * @property string last_name
 * @property string care_of
 * @property string company
 * @property string extended_zip
 * @property string phone
 * @property User creator
 * @property User updater
 * @property Carbon created_at
 * @property Carbon updated_at
 * // Raw relations
 * @property int domestic_address_id
 * @property string addressable_type
 * @property int addressable_id
 * @property int creator_id
 * @property int updater_id
 */
class Address extends BaseModel
{
    use HasCreator;
    use HasPackageFactory;
    use HasUpdater;

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Address $address) {
            Assert::lazy()
                ->that($address->domestic_address_id)->notEmpty('An address must have a US domestic postal address.')
                ->verifyNow();
        });
    }

    public function getTransformer($context = null)
    {
        return new AddressTransformer();
    }

    public function domesticAddress()
    {
        return $this->belongsTo(app('domestic_address'));
    }

    public function addressable()
    {
        return $this->morphTo();
    }

    public function phone()
    {
        return $this->belongsTo(app('phone'));
    }
}
