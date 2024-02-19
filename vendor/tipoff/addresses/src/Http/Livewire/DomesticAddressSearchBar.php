<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use Tipoff\Addresses\Collections\DomesticAddressCollection;

class DomesticAddressSearchBar extends Component
{
    public $query;

    public $results;

    public $autocompleteParams;

    public $placeDetailsParams;

    protected $rules = [
        'query' => ['regex:/^\d/'],
    ];

    protected $messages = [
        'query.regex' => 'Please enter a street number.',
    ];

    public function mount()
    {
        $sessionToken = (string)Str::uuid();

        // Restrict results to 'address' type only in US
        $this->autocompleteParams = [
            'sessiontoken' => $sessionToken,
            'components' => 'country:us',
            'types' => 'address',
        ];

        $this->placeDetailsParams = [
            'sessiontoken' => $sessionToken,
            // can retrieve more fields if needed for data consistency e.g. timezone
            'fields' => 'address_component',
        ];
    }

    public function getPlaceDetails(string $placeId)
    {
        $placeDetailsCollection = app()->make(\Tipoff\GoogleApi\GoogleServices::class)->places()->placeDetails($placeId, $this->placeDetailsParams);
        $components = new DomesticAddressCollection($placeDetailsCollection['result']['address_components'] ?? []);

        $newSessionToken = (string)Str::uuid();
        $this->autocompleteParams['sessiontoken'] = $newSessionToken;
        $this->placeDetailsParams['sessiontoken'] = $newSessionToken;

        $this->dispatchBrowserEvent('focus-address-line-2');
        $this->emit('populateFields', [
            'addressLine1' => $components->addressLine1(),
            'zip' => $components->postalCode(),
            'city' => $components->city(),
            'state' => $components->state(),
        ]);
    }

    public function updatedQuery()
    {
        if (! empty($this->query)) {
            $this->validate();
            $resultsCollection = app()->make(\Tipoff\GoogleApi\GoogleServices::class)->places()->placeAutocomplete($this->query, $this->autocompleteParams);
            $this->results = $resultsCollection['predictions'];
        }
        // $resultsCollection['status'] is handled by SKAgarwal/PlacesApi package
        // https://github.com/SachinAgarwal1337/google-places-api/blob/2f2b474b706e362778c5642ac1524619afda9126/src/PlacesApi.php#L240
    }

    public function render()
    {
        return view('addresses::livewire.domestic-address-search-bar');
    }
}
