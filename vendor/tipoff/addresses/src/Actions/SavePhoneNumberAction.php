<?php namespace Tipoff\Addresses\Actions;

use libphonenumber\PhoneNumberUtil;
use Tipoff\Addresses\Models\CountryCallingcode;

class SavePhoneNumberAction
{
    /**
     * @param string $phoneNumber
     * @return mixed
     * @throws \libphonenumber\NumberParseException
     */
    public function execute(string $phoneNumber)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        $parsedPhoneNumber = $phoneUtil->parse($phoneNumber, 'US');

        /**
         * Only save US phone number.
         * https://github.com/tipoff/addresses/issues/73
         */
        if ($parsedPhoneNumber->getCountryCode() !== 1) {
            throw new \Exception('Please enter an US phone number!');
        }

        /** @var CountryCallingcode $countryCallingCode */
        $countryCallingCode = CountryCallingcode::where('code', $parsedPhoneNumber->getCountryCode())->first();

        return optional($countryCallingCode)->phones()->firstOrCreate([
            'full_number' => $phoneNumber,
            'phone_area_code' => $this->getAreaCode($parsedPhoneNumber->getNationalNumber()), // This only work for US area code.
        ]);
    }

    /**
     * @param string $phoneNumber
     * @return string
     */
    private function getAreaCode(string $phoneNumber)
    {
        return substr($phoneNumber, 0, 3);
    }
}
