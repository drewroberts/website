<?php

declare(strict_types = 1);

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Tipoff\Addresses\Models\Zip;
use Tipoff\Addresses\Models\State;
use Tipoff\Addresses\Models\Timezone;

class AddZipsSecond extends Migration {

    public function up() {

        $zipData = [
	    [
                'code' => '96939',
                'state_abbreviation' => 'PW',
                'region_id' => NULL,
                'timezone_php' => 'Pacific/Palau',
                'population' => NULL,
                'density' => NULL,
                'latitude' => '7.36694',
                'longitude' => '134.15395',
                'military' => false,
                'ztca' => false,
                'parent_zip_code' => '96915',
        ],
        [       
                'code' => '96940',
                'state_abbreviation' => 'PW',
                'region_id' => NULL,
                'timezone_php' => 'Pacific/Palau',
                'population' => NULL,
                'density' => NULL,
                'latitude' => '7.36694',
                'longitude' => '134.15395',
                'military' => false,
                'ztca' => false,
                'parent_zip_code' => '96915',
        ],
        [       
                'code' => '96941',
                'state_abbreviation' => 'FM',
                'region_id' => NULL,
                'timezone_php' => 'Pacific/Pohnpei',
                'population' => NULL,
                'density' => NULL,
                'latitude' => '6.96612',
                'longitude' => '158.20205',
                'military' => false,
                'ztca' => false,
                'parent_zip_code' => '96951',
        ],
        [       
                'code' => '96942',
                'state_abbreviation' => 'FM',
                'region_id' => NULL,
                'timezone_php' => 'Pacific/Chuuk',
                'population' => NULL,
                'density' => NULL,
                'latitude' => '7.35551',
                'longitude' => '151.56127',
                'military' => false,
                'ztca' => false,
                'parent_zip_code' => '96917',
        ],
        [       
                'code' => '96943',
                'state_abbreviation' => 'FM',
                'region_id' => NULL,
                'timezone_php' => 'Pacific/Yap',
                'population' => NULL,
                'density' => NULL,
                'latitude' => '9.51765',
                'longitude' => '138.12205',
                'military' => false,
                'ztca' => false,
                'parent_zip_code' => '96915',
        ],
        [
                'code' => '96944',
                'state_abbreviation' => 'FM',
                'region_id' => NULL,
                'timezone_php' => 'Pacific/Kosrae',
                'population' => NULL,
                'density' => NULL,
                'latitude' => '5.31505',
                'longitude' => '162.89976',
                'military' => false,
                'ztca' => false,
                'parent_zip_code' => '96951',
        ],
        [
                'code' => '96960',
                'state_abbreviation' => 'MH',
                'region_id' => NULL,
                'timezone_php' => 'Pacific/Majuro',
                'population' => NULL,
                'density' => NULL,
                'latitude' => '7.10346',
                'longitude' => '171.01735',
                'military' => false,
                'ztca' => false,
                'parent_zip_code' => '67623',
        ],
        [
                'code' => '96970',
                'state_abbreviation' => 'MH',
                'region_id' => NULL,
                'timezone_php' => 'Pacific/Kwajalein',
                'population' => NULL,
                'density' => NULL,
                'latitude' => '8.78176',
                'longitude' => '167.72828',
                'military' => false,
                'ztca' => false,
                'parent_zip_code' => '96950',
        ],
   ];

	$now = Carbon::now()->format('Y-m-d H:i:s');
        foreach ($zipData as $record) {
	   $state = State::fromAbbreviation($record['state_abbreviation']);
           $stateId = null;
           if ($state != null) {
                $stateId = $state->getId();
           }
           if ($record['timezone_php'] == NULL) {
                $timezoneId = null;
           } else {
                $timezoneName = Timezone::getNameFromPHP($record['timezone_php']);
                $timezoneId = Timezone::fromAbbreviation($timezoneName)->getId();
           }
           unset($record['state_abbreviation'], $record['timezone_php']);
           $insertRecord = array_merge($record, [
                'state_id' => $stateId,
                'timezone_id' => $timezoneId,
                'created_at' => $now,
           ]);
           Zip::query()->insertOrIgnore($insertRecord);
        }
   }
}



