<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Http\Livewire;

use Livewire\Component;

class DomesticAddressSearchBarFields extends Component
{
    public $addressLine1;
    public $zip;
    public $city;
    public $state;

    protected $listeners = ['populateFields'];

    public function populateFields(array $components)
    {
        $this->addressLine1 = $components['addressLine1'];
        $this->zip = $components['zip'];
        $this->city = $components['city'];
        $this->state = $components['state'];
    }

    public function render()
    {
        return view('addresses::livewire.domestic-address-search-bar-fields');
    }
}
