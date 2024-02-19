<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Transformers;

use Tipoff\Addresses\Models\Country;
use Tipoff\Support\Transformers\BaseTransformer;

class CountryTransformer extends BaseTransformer
{
    protected $defaultIncludes = [
    ];

    protected $availableIncludes = [
    ];

    public function transform(Country $country)
    {
        return [
            'id' => $country->id,
            'slug' => $country->slug,
            'title' => $country->title,
            'official' => $country->official,
            'abbreviation' => $country->abbreviation,
            'capital' => $country->capital,
            'created_at' => (string) $country->created_at,
            'updated_at' => (string) $country->updated_at,
        ];
    }
}
