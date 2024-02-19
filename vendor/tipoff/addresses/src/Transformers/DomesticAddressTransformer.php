<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Transformers;

use Tipoff\Addresses\Models\DomesticAddress;
use Tipoff\Support\Transformers\BaseTransformer;

class DomesticAddressTransformer extends BaseTransformer
{
    protected $defaultIncludes = [
    ];

    protected $availableIncludes = [
        'zip',
    ];

    public function transform(DomesticAddress $domesticAddress)
    {
        return [
            'id' => $domesticAddress->id,
            'address_line_1' => $domesticAddress->address_line_1,
            'address_line_2' => $domesticAddress->address_line_2,
            'city' => $domesticAddress->city->title,
            'state' => $domesticAddress->zip->state->abbreviation,
            'zip_code' => $domesticAddress->zip->code,
            'created_at' => (string) $domesticAddress->created_at,
            'updated_at' => (string) $domesticAddress->updated_at,
        ];
    }

    public function includeZip(DomesticAddress $domesticAddress)
    {
        return $this->item($domesticAddress->zip, new ZipTransformer());
    }
}
