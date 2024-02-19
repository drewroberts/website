<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Transformers;

use Tipoff\Addresses\Models\Zip;
use Tipoff\Support\Transformers\BaseTransformer;

class ZipTransformer extends BaseTransformer
{
    protected $defaultIncludes = [
    ];

    protected $availableIncludes = [
        'state',
        'region',
        'timezone',
    ];

    public function transform(Zip $zip)
    {
        return [
            'code' => $zip->code,
            'state_id' => $zip->state_id,
            'region_id' => $zip->region_id,
            'timezone_id' => $zip->timezone_id,
            'latitude' => $zip->latitude,
            'longitude' => $zip->longitude,
            'decommissioned' => $zip->decommissioned,
            'created_at' => (string) $zip->created_at,
            'updated_at' => (string) $zip->updated_at,
        ];
    }

    public function includeState(Zip $zip)
    {
        return $this->item($zip->state, new StateTransformer());
    }

    public function includeRegion(Zip $zip)
    {
        return $zip->region ? $this->item($zip->region, new RegionTransformer()) : null;
    }

    public function includeTimezone(Zip $zip)
    {
        return $zip->timezone ? $this->item($zip->timezone, new TimezoneTransformer()) : null;
    }
}
