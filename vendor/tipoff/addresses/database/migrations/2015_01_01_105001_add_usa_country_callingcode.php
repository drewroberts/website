<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Tipoff\Addresses\Models\Country;
use Tipoff\Addresses\Models\CountryCallingcode;

class AddUsaCountryCallingcode extends Migration
{
    public function up()
    {
        $callingcodeData = [
            [
                'country_id' => Country::fromAbbreviation('USA')->getId(),
                'code' => 1,
                'display' => '+1',
                'root' => '+1',
                'suffix' => NULL,
            ]
        ];

        CountryCallingcode::query()->insertOrIgnore($callingcodeData);
    }
}
