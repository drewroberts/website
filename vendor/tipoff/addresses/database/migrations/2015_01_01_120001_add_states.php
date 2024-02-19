<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Tipoff\Addresses\Models\Country;
use Tipoff\Addresses\Models\State;

class AddStates extends Migration
{
    public function up()
    {
        $stateData = [
            [
                'slug' => 'florida',
                'title' => 'Florida',
                'abbreviation' => 'FL',
                'capital' => 'Tallahassee',
            ],
            [
                'slug' => 'kentucky',
                'title' => 'Kentucky',
                'abbreviation' => 'KY',
                'capital' => 'Frankfort',
            ],
            [
                'slug' => 'alabama',
                'title' => 'Alabama',
                'abbreviation' => 'AL',
                'capital' => 'Montgomery',
            ],
            [
                'slug' => 'alaska',
                'title' => 'Alaska',
                'abbreviation' => 'AK',
                'capital' => 'Juneau',
            ],
            [
                'slug' => 'arizona',
                'title' => 'Arizona',
                'abbreviation' => 'AZ',
                'capital' => 'Phoenix',
            ],
            [
                'slug' => 'arkansas',
                'title' => 'Arkansas',
                'abbreviation' => 'AR',
                'capital' => 'Little Rock',
            ],
            [
                'slug' => 'california',
                'title' => 'California',
                'abbreviation' => 'CA',
                'capital' => 'Sacramento',
            ],
            [
                'slug' => 'colorado',
                'title' => 'Colorado',
                'abbreviation' => 'CO',
                'capital' => 'Denver',
            ],
            [
                'slug' => 'connecticut',
                'title' => 'Connecticut',
                'abbreviation' => 'CT',
                'capital' => 'Hartford',
            ],
            [
                'slug' => 'delaware',
                'title' => 'Delaware',
                'abbreviation' => 'DE',
                'capital' => 'Dover',
            ],
            [
                'slug' => 'georgia',
                'title' => 'Georgia',
                'abbreviation' => 'GA',
                'capital' => 'Atlanta',
            ],
            [
                'slug' => 'hawaii',
                'title' => 'Hawaii',
                'abbreviation' => 'HI',
                'capital' => 'Honolulu',
            ],
            [
                'slug' => 'idaho',
                'title' => 'Idaho',
                'abbreviation' => 'ID',
                'capital' => 'Boise',
            ],
            [
                'slug' => 'illinois',
                'title' => 'Illinois',
                'abbreviation' => 'IL',
                'capital' => 'Springfield',
            ],
            [
                'slug' => 'indiana',
                'title' => 'Indiana',
                'abbreviation' => 'IN',
                'capital' => 'Indianapolis',
            ],
            [
                'slug' => 'iowa',
                'title' => 'Iowa',
                'abbreviation' => 'IA',
                'capital' => 'Des Moines',
            ],
            [
                'slug' => 'kansas',
                'title' => 'Kansas',
                'abbreviation' => 'KS',
                'capital' => 'Topeka',
            ],
            [
                'slug' => 'louisiana',
                'title' => 'Louisiana',
                'abbreviation' => 'LA',
                'capital' => 'Baton Rouge',
            ],
            [
                'slug' => 'maine',
                'title' => 'Maine',
                'abbreviation' => 'ME',
                'capital' => 'Augusta',
            ],
            [
                'slug' => 'maryland',
                'title' => 'Maryland',
                'abbreviation' => 'MD',
                'capital' => 'Annapolis',
            ],
            [
                'slug' => 'massachusetts',
                'title' => 'Massachusetts',
                'abbreviation' => 'MA',
                'capital' => 'Boston',
            ],
            [
                'slug' => 'michigan',
                'title' => 'Michigan',
                'abbreviation' => 'MI',
                'capital' => 'Lansing',
            ],
            [
                'slug' => 'minnesota',
                'title' => 'Minnesota',
                'abbreviation' => 'MN',
                'capital' => 'Saint Paul',
            ],
            [
                'slug' => 'mississippi',
                'title' => 'Mississippi',
                'abbreviation' => 'MS',
                'capital' => 'Jackson',
            ],
            [
                'slug' => 'missouri',
                'title' => 'Missouri',
                'abbreviation' => 'MO',
                'capital' => 'Jefferson City',
            ],
            [
                'slug' => 'montana',
                'title' => 'Montana',
                'abbreviation' => 'MT',
                'capital' => 'Helena',
            ],
            [
                'slug' => 'nebraska',
                'title' => 'Nebraska',
                'abbreviation' => 'NE',
                'capital' => 'Lincoln',
            ],
            [
                'slug' => 'nevada',
                'title' => 'Nevada',
                'abbreviation' => 'NV',
                'capital' => 'Carson City',
            ],
            [
                'slug' => 'new-hampshire',
                'title' => 'New Hampshire',
                'abbreviation' => 'NH',
                'capital' => 'Concord',
            ],
            [
                'slug' => 'new-jersey',
                'title' => 'New Jersey',
                'abbreviation' => 'NJ',
                'capital' => 'Trenton',
            ],
            [
                'slug' => 'new-mexico',
                'title' => 'New Mexico',
                'abbreviation' => 'NM',
                'capital' => 'Santa Fe',
            ],
            [
                'slug' => 'new-york',
                'title' => 'New York',
                'abbreviation' => 'NY',
                'capital' => 'Albany',
            ],
            [
                'slug' => 'north-carolina',
                'title' => 'North Carolina',
                'abbreviation' => 'NC',
                'capital' => 'Raleigh',
            ],
            [
                'slug' => 'north-dakota',
                'title' => 'North Dakota',
                'abbreviation' => 'ND',
                'capital' => 'Bismarck',
            ],
            [
                'slug' => 'ohio',
                'title' => 'Ohio',
                'abbreviation' => 'OH',
                'capital' => 'Columbus',
            ],
            [
                'slug' => 'oklahoma',
                'title' => 'Oklahoma',
                'abbreviation' => 'OK',
                'capital' => 'Oklahoma City',
            ],
            [
                'slug' => 'oregon',
                'title' => 'Oregon',
                'abbreviation' => 'OR',
                'capital' => 'Salem',
            ],
            [
                'slug' => 'pennsylvania',
                'title' => 'Pennsylvania',
                'abbreviation' => 'PA',
                'capital' => 'Harrisburg',
            ],
            [
                'slug' => 'rhode-island',
                'title' => 'Rhode Island',
                'abbreviation' => 'RI',
                'capital' => 'Providence',
            ],
            [
                'slug' => 'south-carolina',
                'title' => 'South Carolina',
                'abbreviation' => 'SC',
                'capital' => 'Columbia',
            ],
            [
                'slug' => 'south-dakota',
                'title' => 'South Dakota',
                'abbreviation' => 'SD',
                'capital' => 'Pierre',
            ],
            [
                'slug' => 'tennessee',
                'title' => 'Tennessee',
                'abbreviation' => 'TN',
                'capital' => 'Nashville',
            ],
            [
                'slug' => 'texas',
                'title' => 'Texas',
                'abbreviation' => 'TX',
                'capital' => 'Austin',
            ],
            [
                'slug' => 'utah',
                'title' => 'Utah',
                'abbreviation' => 'UT',
                'capital' => 'Salt Lake City',
            ],
            [
                'slug' => 'vermont',
                'title' => 'Vermont',
                'abbreviation' => 'VT',
                'capital' => 'Montpelier',
            ],
            [
                'slug' => 'virginia',
                'title' => 'Virginia',
                'abbreviation' => 'VA',
                'capital' => 'Richmond',
            ],
            [
                'slug' => 'washington',
                'title' => 'Washington',
                'abbreviation' => 'WA',
                'capital' => 'Olympia',
            ],
            [
                'slug' => 'west-virginia',
                'title' => 'West Virginia',
                'abbreviation' => 'WV',
                'capital' => 'Charleston',
            ],
            [
                'slug' => 'wisconsin',
                'title' => 'Wisconsin',
                'abbreviation' => 'WI',
                'capital' => 'Madison',
            ],
            [
                'slug' => 'wyoming',
                'title' => 'Wyoming',
                'abbreviation' => 'WY',
                'capital' => 'Cheyenne',
            ],
            [
                'slug' => 'dc',
                'title' => 'District of Columbia',
                'abbreviation' => 'DC',
                'capital' => 'Washington',
            ],
            [
                'slug' => 'puerto-rico',
                'title' => 'Puerto Rico',
                'abbreviation' => 'PR',
                'capital' => 'San Juan',
            ],
            [
                'slug' => 'virgin-islands',
                'title' => 'Virgin Islands',
                'abbreviation' => 'VI',
                'capital' => null,
            ],
            [
                'slug' => 'guam',
                'title' => 'Guam',
                'abbreviation' => 'GU',
                'capital' => null,
            ],
            [
                'slug' => 'us-armed-forces-americas',
                'title' => 'US Armed Forces – Americas',
                'abbreviation' => 'AA',
                'capital' => null,
            ],
            [
                'slug' => 'us-armed-forces-europe',
                'title' => 'US Armed Forces – Europe',
                'abbreviation' => 'AE',
                'capital' => null,
            ],
            [
                'slug' => 'us-armed-forces-pacific',
                'title' => 'US Armed Forces – Pacific',
                'abbreviation' => 'AP',
                'capital' => null,
            ],
            [
                'slug' => 'samoa',
                'title' => 'American Samoa',
                'abbreviation' => 'AS',
                'capital' => null,
            ],
            [
                'slug' => 'mariana-islands',
                'title' => 'Mariana Islands',
                'abbreviation' => 'MP',
                'capital' => null,
            ]
        ];

        $now = Carbon::now()->format('Y-m-d H:i:s');
        $countryId = Country::fromAbbreviation('USA')->getId();
        $stateRecords = collect($stateData)
            ->map(function (array $record) use ($now, $countryId) {
                return array_merge($record, [
                    'country_id' => $countryId,
                ]);
            })
            ->toArray();

        State::query()->insertOrIgnore($stateRecords);
    }
}
