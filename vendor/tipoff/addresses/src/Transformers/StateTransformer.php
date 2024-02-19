<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Transformers;

use Tipoff\Addresses\Models\State;
use Tipoff\Support\Transformers\BaseTransformer;

class StateTransformer extends BaseTransformer
{
    protected $defaultIncludes = [
    ];

    protected $availableIncludes = [
        'country',
    ];

    public function transform(State $state)
    {
        return [
            'id' => $state->id,
            'slug' => $state->slug,
            'title' => $state->title,
            'abbreviation' => $state->abbreviation,
            'description' => $state->description,
            'capital' => $state->capital,
            'country_id' => $state->country_id,
            'created_at' => (string) $state->created_at,
            'updated_at' => (string) $state->updated_at,
        ];
    }

    public function includeCountry(State $state)
    {
        return $this->item($state->country, new CountryTransformer);
    }
}
