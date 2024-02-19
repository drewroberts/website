<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Tipoff\Addresses\Models\Timezone;

class AddWorldTimezones extends Migration
{
    public function up()
    {

        if (class_exists(Timezone::class)) {
            Timezone::query()->insertOrIgnore([
                [
                    'name'               => 'NZDT',
                    'title'              => 'New Zealand',
                    'php'                => 'Pacific/Auckland',
                    'is_daylight_saving' => 1,
                    'dst'                => '+12.00',
                    'standard'           => '+11.00',
                ],
                [
                    'name'               => 'AEST',
                    'title'              => 'E. Australia Standard',
                    'php'                => 'Australia/Brisbane',
                    'is_daylight_saving' => 1,
                    'dst'                => '+11.00',
                    'standard'           => '+10.00',
                ],
                [
                    'name'               => 'AEDT',
                    'title'              => 'AUS Eastern Standard',
                    'php'                => 'Australia/Sydney',
                    'is_daylight_saving' => 1,
                    'dst'                => '+12.00',
                    'standard'           => '+11.00',
                ],
                [
                    'name'               => 'JST',
                    'title'              => 'Tokyo Standard',
                    'php'                => 'Asia/Tokyo',
                    'is_daylight_saving' => 0,
                    'dst'                => '+9.00',
                    'standard'           => '+9.00',
                ],
                [
                    'name'               => 'CST',
                    'title'              => 'China Standard',
                    'php'                => 'Asia/Shanghai',
                    'is_daylight_saving' => 0,
                    'dst'                => '+8.00',
                    'standard'           => '+8.00',
                ],
                [
                    'name'               => 'WIB',
                    'title'              => 'Western Indonesian',
                    'php'                => 'Asia/Jakarta',
                    'is_daylight_saving' => 0,
                    'dst'                => '+7.00',
                    'standard'           => '+7.00',
                ],
                [
                    'name'               => 'MMT',
                    'title'              => 'Myanmar Standard',
                    'php'                => 'Asia/Rangoon',
                    'is_daylight_saving' => 0,
                    'dst'                => '+6.30',
                    'standard'           => '+6.30',
                ],
                [
                    'name'               => 'BST',
                    'title'              => 'Bangladesh Standard',
                    'php'                => 'Asia/Dhaka',
                    'is_daylight_saving' => 0,
                    'dst'                => '+6.00',
                    'standard'           => '+6.00',
                ],
                [
                    'name'               => 'NPT',
                    'title'              => 'Nepal Standard',
                    'php'                => 'Asia/Kathmandu',
                    'is_daylight_saving' => 0,
                    'dst'                => '+5.45',
                    'standard'           => '+5.45',
                ],
                [
                    'name'               => 'IST',
                    'title'              => 'India Standard',
                    'php'                => 'Asia/Kolkata',
                    'is_daylight_saving' => 0,
                    'dst'                => '+5.30',
                    'standard'           => '+5.30',
                ],
                [
                    'name'               => 'AFT',
                    'title'              => 'Afghanistan Standard',
                    'php'                => 'Asia/Kabul',
                    'is_daylight_saving' => 0,
                    'dst'                => '+4.30',
                    'standard'           => '+4.30',
                ],
                [
                    'name'               => 'PKT',
                    'title'              => 'Pakistan Standard',
                    'php'                => 'Asia/Karachi',
                    'is_daylight_saving' => 0,
                    'dst'                => '+5.00',
                    'standard'           => '+5.00',
                ],
                [
                    'name'               => 'AFT',
                    'title'              => 'Afghanistan Standard',
                    'php'                => 'Asia/Kabul',
                    'is_daylight_saving' => 0,
                    'dst'                => '+4.30',
                    'standard'           => '+4.30',
                ],
                [
                    'name'               => 'IRDT',
                    'title'              => 'Iran Daylight',
                    'php'                => 'Asia/Tehran',
                    'is_daylight_saving' => 1,
                    'dst'                => '+4.30',
                    'standard'           => '+3.30',
                ],
                [
                    'name'               => 'AZT',
                    'title'              => 'Azerbaijan Standard',
                    'php'                => 'Asia/Baku',
                    'is_daylight_saving' => 0,
                    'dst'                => '+4.00',
                    'standard'           => '+4.00',
                ],
                [
                    'name'               => 'MSK',
                    'title'              => 'Russian Standard',
                    'php'                => 'Europe/Moscow',
                    'is_daylight_saving' => 0,
                    'dst'                => '+3.00',
                    'standard'           => '+3.00',
                ],
                [
                    'name'               => 'EET',
                    'title'              => 'Egypt Standard',
                    'php'                => 'Africa/Cairo',
                    'is_daylight_saving' => 0,
                    'dst'                => '+2.00',
                    'standard'           => '+2.00',
                ],
                [
                    'name'               => 'WAT',
                    'title'              => 'West Africa',
                    'php'                => 'Europe/Moscow',
                    'is_daylight_saving' => 0,
                    'dst'                => '+2.00',
                    'standard'           => '+2.00',
                ],
                [
                    'name'               => 'CET',
                    'title'              => 'Central European',
                    'php'                => 'Europe/Berlin',
                    'is_daylight_saving' => 1,
                    'dst'                => '+2.00',
                    'standard'           => '+1.00',
                ],
                [
                    'name'               => 'GMT',
                    'title'              => 'Greenwich Mean',
                    'php'                => 'Asia/Baku',
                    'is_daylight_saving' => 1,
                    'dst'                => '+1.00',
                    'standard'           => '+0.00',
                ],
                [
                    'name'               => 'CVT',
                    'title'              => 'Cape Verde Standard',
                    'php'                => 'Atlantic/Cape_Verde',
                    'is_daylight_saving' => 0,
                    'dst'                => '-1.00',
                    'standard'           => '-1.00',
                ],
                [
                    'name'               => 'BRT',
                    'title'              => 'E. South America Standard',
                    'php'                => 'America/Sao_Paulo',
                    'is_daylight_saving' => 1,
                    'dst'                => '-1.00',
                    'standard'           => '-1.00',
                ],
                [
                    'name'               => 'NDT',
                    'title'              => 'Newfoundland Standard',
                    'php'                => 'America/St_Johns',
                    'is_daylight_saving' => 1,
                    'dst'                => '-2.30',
                    'standard'           => '-3.30',
                ],
                [
                    'name'               => 'AMT',
                    'title'              => 'Central Brazilian Standard',
                    'php'                => 'America/Manaus',
                    'is_daylight_saving' => 0,
                    'dst'                => '-4.00',
                    'standard'           => '-4.00',
                ],
                [
                    'name'               => 'CLT',
                    'title'              => 'Chile Standard',
                    'php'                => 'America/Santiago',
                    'is_daylight_saving' => 1,
                    'dst'                => '-4.00',
                    'standard'           => '-3.00',
                ],
            ]);
        }
    }
}
