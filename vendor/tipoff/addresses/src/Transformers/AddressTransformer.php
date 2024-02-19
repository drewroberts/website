<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Transformers;

use Tipoff\Addresses\Models\Address;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Transformers\BaseTransformer;

class AddressTransformer extends BaseTransformer
{
    protected $defaultIncludes = [
        'domestic_address',
    ];

    protected $availableIncludes = [
        'domestic_address',
        'addressable',
    ];

    public function transform(Address $address)
    {
        return [
            'id' => $address->getId(),
            'addressable_type' => $address->addressable_type,
            'addressable_id' => $address->addressable_id,
            'type' => $address->type,
            'first_name' => $address->first_name,
            'last_name' => $address->last_name,
            'care_of' => $address->care_of,
            'company' => $address->company,
            'extended_zip' => $address->extended_zip,
            'phone' => $address->phone,
            'creator_id' => $address->creator_id,
            'updater_id' => $address->updater_id,
            'created_at' => (string) $address->created_at,
            'updated_at' => (string) $address->updated_at,
        ];
    }

    public function includeDomesticAddress(Address $address)
    {
        return $this->item($address->domesticAddress, new DomesticAddressTransformer());
    }

    public function includeAddressable(Address $address)
    {
        /** @var BaseModel $addressable */
        $addressable = $address->addressable;
        $transformer = $addressable->getTransformer();

        return $transformer ? $this->item($addressable, $transformer) : null;
    }
}
