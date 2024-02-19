<?php namespace Tipoff\Addresses\Collections;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class DomesticAddressCollection extends Collection
{
    /**
     * @return string
     */
    public function addressLine1(): string
    {
        $streetNumber = $this->first(fn ($component) => Arr::get($component, 'types.0') === 'street_number');
        $street = $this->first(fn ($component) => Arr::get($component, 'types.0') === 'route');

        return trim(($streetNumber['long_name'] ?? '') . ' ' . ($street['long_name'] ?? ''));
    }

    /**
     * @return string
     */
    public function postalCode(): string
    {
        $postalCode = $this->first(fn ($component) => Arr::get($component, 'types.0') === 'postal_code');

        return $postalCode['long_name'] ?? '';
    }

    /**
     * @return string
     */
    public function city(): string
    {
        $city = $this->first(fn ($component) => Arr::get($component, 'types.0') === 'locality');

        return $city['long_name'] ?? '';
    }

    /**
     * @return string
     */
    public function state(): string
    {
        $state = $this->first(fn ($component) => Arr::get($component, 'types.0') === 'administrative_area_level_1');

        return $state['short_name'] ?? '';
    }
}
