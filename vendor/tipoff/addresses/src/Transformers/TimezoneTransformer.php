<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Transformers;

use Tipoff\Addresses\Models\Timezone;
use Tipoff\Support\Transformers\BaseTransformer;

class TimezoneTransformer extends BaseTransformer
{
    protected $defaultIncludes = [
    ];

    protected $availableIncludes = [
    ];

    public function transform(Timezone $timezone)
    {
        return [
            'id' => $timezone->id,
            'name' => $timezone->name,
            'title' => $timezone->title,
            'php' => $timezone->php,
            'is_daylight_saving' => $timezone->is_daylight_saving,
            'dst' => $timezone->dst,
            'standard' => $timezone->standard,
        ];
    }
}
