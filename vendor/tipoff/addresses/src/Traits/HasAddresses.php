<?php

declare(strict_types=1);

namespace Tipoff\Addresses\Traits;

use Illuminate\Support\Collection;
use Tipoff\Addresses\Models\Address;
use Tipoff\Addresses\Models\City;
use Tipoff\Addresses\Models\DomesticAddress;
use Tipoff\Addresses\Models\Zip;

/**
 * @property Collection addresses
 */
trait HasAddresses
{
    /**
     * @param string $line1
     * @param string|null $line2
     * @param string|City $city
     * @param string|Zip $zip
     * @return DomesticAddress
     */
    public static function createDomesticAddress(string $line1, ?string $line2, $city, $zip): DomesticAddress
    {
        return DomesticAddress::createDomesticAddress($line1, $line2, $city, $zip);
    }

    public function getAddressByType(string $type): ?Address
    {
        return $this->addresses
            ->filter(function (Address $address) use ($type) {
                return $address->type === $type;
            })
            ->first();
    }

    public function setAddressByType(string $type, DomesticAddress $domesticAddress): Address
    {
        $address = $this->getAddressByType($type);
        if (! $address) {
            $address = new Address();
            $address->type = $type;
            $address->addressable()->associate($this);
        }

        $address->domesticAddress()->associate($domesticAddress)->save();
        $address->load('domesticAddress');
        $this->load('addresses');

        return $address;
    }

    public function getAddress(): ?Address
    {
        return $this->getAddressByType(get_class($this));
    }

    public function setAddress(DomesticAddress $domesticAddress): Address
    {
        return $this->setAddressByType(get_class($this), $domesticAddress);
    }

    public function copyAddressesToTarget($target, ?\Closure $filter = null): self
    {
        $this->addresses
            ->filter(function (Address $sourceAddress) use ($filter) {
                return empty($filter) || ($filter)($sourceAddress);
            })
            ->each(function (Address $sourceAddress) use ($target) {
                // Create a copy, replacing the addressable with the target before saving
                $targetAddress = $sourceAddress->replicate();
                $targetAddress->addressable()->associate($target)->save();
            });

        return $this;
    }

    public function addresses()
    {
        return $this->morphMany(app('address'), 'addressable');
    }
}
