<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Transformers;

use Tipoff\Addresses\Models\Region;
use Tipoff\Support\Transformers\BaseTransformer;

class RegionTransformer extends BaseTransformer
{
    protected $defaultIncludes = [
    ];

    protected $availableIncludes = [
    ];

    public function transform(Region $region)
    {
        return [
            'id' => $region->id,
            'slug' => $region->slug,
            'name' => $region->name,
            'creator_id' => $region->creator_id,
            'updater_id' => $region->updater_id,
            'created_at' => (string) $region->created_at,
            'updated_at' => (string) $region->updated_at,
        ];
    }
}
