<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Models;

use Assert\Assert;
use Carbon\Carbon;
use Tipoff\Addresses\Transformers\ZipTransformer;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

/**
 * @property string code
 * @property State state
 * @property Region|null region
 * @property Timezone|null timezone
 * @property float|null latitude
 * @property float|null longitude
 * @property bool decommissioned
 * @property Carbon created_at
 * @property Carbon updated_at
 * // raw relations
 * @property int state_id
 * @property int region_id
 * @property int timezone_id
 */
class Zip extends BaseModel
{
    use HasPackageFactory;

    // These 3 lines of code allow the use of a string as primary key other than ID.
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $keyType = 'string';

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'decommissioned' => 'bool',
        'state_id' => 'integer',
        'region_id' => 'integer',
        'timezone_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (Zip $zip) {
            Assert::lazy()
                ->that($zip->code)->notEmpty('A ZIP must have a code.')
                ->that($zip->state_id)->notEmpty('A ZIP Code must belong to a state.')
                ->verifyNow();
        });
    }

    public function getTransformer($context = null)
    {
        return new ZipTransformer();
    }

    public function cities()
    {
        return $this->belongsToMany(app('city'))
            ->withPivot('primary')
            ->withTimestamps();
    }

    public function domesticAddresses()
    {
        return $this->hasMany(app('domestic_address'));
    }

    public function parent()
    {
        return $this->belongsTo(app('zip'), 'parent_zip_code');
    }

    public function region()
    {
        return $this->belongsTo(app('region'));
    }

    public function state()
    {
        return $this->belongsTo(app('state'));
    }

    public function timezone()
    {
        return $this->belongsTo(app('timezone'));
    }
}
