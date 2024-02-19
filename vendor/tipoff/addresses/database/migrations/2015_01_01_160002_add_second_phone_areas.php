<?php

declare(strict_types = 1);

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Tipoff\Addresses\Models\PhoneArea;
use Tipoff\Addresses\Models\State;

class AddSecondPhoneAreas extends Migration {

    public function up() {

        $phoneAreaData = [
                [
                    'code' => 612,
                    'state_abbreviation' => 'MN',
                    'note' => 'Cent. Minnesota: Minneapolis (split from St. Paul, see 651; see splits 763, 952)'
            ],
                [
                    'code' => 651,
                    'state_abbreviation' => 'MN',
                    'note' => 'Cent. Minnesota: St. Paul (split from Minneapolis, see 612)'
            ],
                [
                    'code' => 763,
                    'state_abbreviation' => 'MN',
                    'note' => 'Minnesota: Minneapolis NW (split from 612; see also 952)'
            ],
                [
                    'code' => 952,
                    'state_abbreviation' => 'MN',
                    'note' => 'Minnesota: Minneapolis SW, Bloomington (split from 612; see also 763)'
            ],
                [
                    'code' => 314,
                    'state_abbreviation' => 'MO',
                    'note' => 'SE Missouri: St Louis city and parts of the metro area only (see 573, 636, overlay 557)'
            ],
                [
                    'code' => 417,
                    'state_abbreviation' => 'MO',
                    'note' => 'SW Missouri: Springfield'
            ],
                [
                    'code' => 557,
                    'state_abbreviation' => 'MO',
                    'note' => 'SE Missouri: St Louis metro area only (cancelled: overlaid on 314)'
            ],
                [
                    'code' => 573,
                    'state_abbreviation' => 'MO',
                    'note' => 'SE Missouri: excluding St Louis metro area, includes Central/East Missouri, area between St. Louis and Kansas City'
            ],
                [
                    'code' => 636,
                    'state_abbreviation' => 'MO',
                    'note' => 'Missouri: W St. Louis metro area of St. Louis county, St. Charles County, Jefferson County area south (between 314 and 573)'
            ],
                [
                    'code' => 660,
                    'state_abbreviation' => 'MO',
                    'note' => 'N Missouri (split from 816)'
            ],
                [
                    'code' => 816,
                    'state_abbreviation' => 'MO',
                    'note' => 'N Missouri: Kansas City (see split 660, overlay 975)'
            ],
                [
                    'code' => 975,
                    'state_abbreviation' => 'MO',
                    'note' => 'N Missouri: Kansas City (overlaid on 816)'
            ],
                [
                    'code' => 670,
                    'state_abbreviation' => 'MP',
                    'note' => 'Commonwealth of the Northern Mariana Islands (CNMI, US Commonwealth)'
            ],
                [
                    'code' => 228,
                    'state_abbreviation' => 'MS',
                    'note' => 'S Mississippi (coastal areas, Biloxi, Gulfport; split from 601)'
            ],
                [
                    'code' => 601,
                    'state_abbreviation' => 'MS',
                    'note' => 'Mississippi: Meridian, Jackson area (see splits 228, 662; overlay 769)'
            ],
                [
                    'code' => 662,
                    'state_abbreviation' => 'MS',
                    'note' => 'N Mississippi: Tupelo, Grenada (split from 601)'
            ],
                [
                    'code' => 769,
                    'state_abbreviation' => 'MS',
                    'note' => 'Mississippi: Meridian, Jackson area (overlaid on 601; perm 7/19/04, mand 3/14/05)'
            ],
                [
                    'code' => 406,
                    'state_abbreviation' => 'MT',
                    'note' => 'Montana'
            ],
                [
                    'code' => 252,
                    'state_abbreviation' => 'NC',
                    'note' => 'E North Carolina (Rocky Mount; split from 919)'
            ],
                [
                    'code' => 336,
                    'state_abbreviation' => 'NC',
                    'note' => 'Cent. North Carolina: Greensboro, Winston-Salem, High Point (split from 910; see overlay 743)'
            ],
                [
                    'code' => 704,
                    'state_abbreviation' => 'NC',
                    'note' => 'W North Carolina: Charlotte (see split 828, overlay 980)'
            ],
                [
                    'code' => 743,
                    'state_abbreviation' => 'NC',
                    'note' => 'Cent. North Carolina: Greensboro, Winston-Salem, High Point (overlaid on 336)'
            ],
                [
                    'code' => 828,
                    'state_abbreviation' => 'NC',
                    'note' => 'W North Carolina: Asheville (split from 704)'
            ],
                [
                    'code' => 910,
                    'state_abbreviation' => 'NC',
                    'note' => 'S Cent. North Carolina: Fayetteville, Wilmington (see 336)'
            ],
                [
                    'code' => 919,
                    'state_abbreviation' => 'NC',
                    'note' => 'E North Carolina: Raleigh (see split 252, overlay 984)'
            ],
                [
                    'code' => 980,
                    'state_abbreviation' => 'NC',
                    'note' => 'North Carolina: (overlay on 704; perm 5/1/00, mand 3/15/01)'
            ],
                [
                    'code' => 984,
                    'state_abbreviation' => 'NC',
                    'note' => 'E North Carolina: Raleigh (overlaid on 919, perm 8/1/01, mand 2/5/02 POSTPONED)'
            ],
                [
                    'code' => 701,
                    'state_abbreviation' => 'ND',
                    'note' => 'North Dakota'
            ],
                [
                    'code' => 308,
                    'state_abbreviation' => 'NE',
                    'note' => 'W Nebraska: North Platte'
            ],
                [
                    'code' => 402,
                    'state_abbreviation' => 'NE',
                    'note' => 'E Nebraska: Omaha, Lincoln'
            ],
                [
                    'code' => 603,
                    'state_abbreviation' => 'NH',
                    'note' => 'New Hampshire'
            ],
                [
                    'code' => 201,
                    'state_abbreviation' => 'NJ',
                    'note' => 'N New Jersey: Jersey City, Hackensack (see split 973, overlay 551)'
            ],
                [
                    'code' => 551,
                    'state_abbreviation' => 'NJ',
                    'note' => 'N New Jersey: Jersey City, Hackensack (overlaid on 201)'
            ],
                [
                    'code' => 609,
                    'state_abbreviation' => 'NJ',
                    'note' => 'S New Jersey: Trenton (see 856)'
            ],
                [
                    'code' => 732,
                    'state_abbreviation' => 'NJ',
                    'note' => 'Cent. New Jersey: Toms River, New Brunswick, Bound Brook (see overlay 848)'
            ],
                [
                    'code' => 848,
                    'state_abbreviation' => 'NJ',
                    'note' => 'Cent. New Jersey: Toms River, New Brunswick, Bound Brook (see overlay 732)'
            ],
                [
                    'code' => 856,
                    'state_abbreviation' => 'NJ',
                    'note' => 'SW New Jersey: greater Camden area, Mt Laurel (split from 609)'
            ],
                [
                    'code' => 862,
                    'state_abbreviation' => 'NJ',
                    'note' => 'N New Jersey: Newark Paterson Morristown (overlaid on 973)'
            ],
                [
                    'code' => 908,
                    'state_abbreviation' => 'NJ',
                    'note' => 'Cent. New Jersey: Elizabeth, Basking Ridge, Somerville, Bridgewater, Bound Brook'
            ],
                [
                    'code' => 973,
                    'state_abbreviation' => 'NJ',
                    'note' => 'N New Jersey: Newark, Paterson, Morristown (see overlay 862; split from 201)'
            ],
                [
                    'code' => 505,
                    'state_abbreviation' => 'NM',
                    'note' => 'North central and northwestern New Mexico (Albuquerque, Santa Fe, Los Alamos; see split 575, eff 10/07/07)'
            ],
                [
                    'code' => 575,
                    'state_abbreviation' => 'NM',
                    'note' => 'New Mexico (Las Cruces, Alamogordo, Roswell; split from 505, eff 10/07/07)'
            ],
                [
                    'code' => 957,
                    'state_abbreviation' => 'NM',
                    'note' => 'New Mexico (pending; region unknown)'
            ],
                [
                    'code' => 702,
                    'state_abbreviation' => 'NV',
                    'note' => 'S. Nevada: Clark County, incl Las Vegas (overlay 725, eff 6/2014; see also 775)'
            ],
                [
                    'code' => 725,
                    'state_abbreviation' => 'NV',
                    'note' => 'S. Nevada: Clark County, incl Las Vegas (overlaid on 702, eff 6/2014; see also 775)'
            ],
                [
                    'code' => 775,
                    'state_abbreviation' => 'NV',
                    'note' => 'N. Nevada: Reno (all of NV except Clark County area; see 702)'
            ],
                [
                    'code' => 212,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York City, New York (Manhattan; see ovelays 332, 646, 917; split 718)'
            ],
                [
                    'code' => 315,
                    'state_abbreviation' => 'NY',
                    'note' => 'N Cent. New York: Syracuse'
            ],
                [
                    'code' => 332,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York City, New York (Manhattan; overlaid on 212, 646, 917)'
            ],
                [
                    'code' => 347,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York City, New York (overlay for 718: NYC area, except Manhattan)'
            ],
                [
                    'code' => 516,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York: Nassau County, Long Island; Hempstead (see split 631)'
            ],
                [
                    'code' => 518,
                    'state_abbreviation' => 'NY',
                    'note' => 'NE New York: Albany'
            ],
                [
                    'code' => 585,
                    'state_abbreviation' => 'NY',
                    'note' => 'NW New York: Rochester (split from 716)'
            ],
                [
                    'code' => 607,
                    'state_abbreviation' => 'NY',
                    'note' => 'S Cent. New York: Ithaca, Binghamton; Catskills'
            ],
                [
                    'code' => 631,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York: Suffolk County, Long Island; Huntington, Riverhead (split 516)'
            ],
                [
                    'code' => 646,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York (overlaid on 212, 332, 917) NYC (mostly mobile)'
            ],
                [
                    'code' => 716,
                    'state_abbreviation' => 'NY',
                    'note' => 'NW New York: Buffalo (see split 585)'
            ],
                [
                    'code' => 718,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York City, New York (Queens, Staten Island, The Bronx, and Brooklyn; also Marble Hill section of Manhattan; see split 212, 347, 929)'
            ],
                [
                    'code' => 845,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York: Poughkeepsie; Nyack, Nanuet, Valley Cottage, New City, Putnam, Dutchess, Rockland, Orange, Ulster and parts of Sullivan counties in New York\'s lower Hudson Valley and Delaware County in the Catskills (see 914; perm 6/5/00)'
            ],
                [
                    'code' => 914,
                    'state_abbreviation' => 'NY',
                    'note' => 'S New York: Westchester County (see 845)'
            ],
                [
                    'code' => 917,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York: New York City (cellular, see 646)'
            ],
                [
                    'code' => 929,
                    'state_abbreviation' => 'NY',
                    'note' => 'New York City, New York (Queens, Staten Island, The Bronx, and Brooklyn; also Marble Hill section of Manhattan; see split 212, 347, 718)'
            ],
                [
                    'code' => 216,
                    'state_abbreviation' => 'OH',
                    'note' => 'Cleveland (see splits 330, 440)'
            ],
                [
                    'code' => 220,
                    'state_abbreviation' => 'OH',
                    'note' => 'SE and Central Ohio (outside Columbus; overlaid on 740)'
            ],
                [
                    'code' => 234,
                    'state_abbreviation' => 'OH',
                    'note' => 'NE Ohio: Canton, Akron (overlaid on 330; perm 10/30/00)'
            ],
                [
                    'code' => 283,
                    'state_abbreviation' => 'OH',
                    'note' => 'SW Ohio: Cincinnati (cancelled: overlaid on 513)'
            ],
                [
                    'code' => 330,
                    'state_abbreviation' => 'OH',
                    'note' => 'NE Ohio: Akron, Canton, Youngstown; Mahoning County, parts of Trumbull/Warren counties (see splits 216, 440, overlay 234)'
            ],
                [
                    'code' => 380,
                    'state_abbreviation' => 'OH',
                    'note' => 'Ohio: Columbus (overlaid on 614; assigned but not in use)'
            ],
                [
                    'code' => 419,
                    'state_abbreviation' => 'OH',
                    'note' => 'NW Ohio: Toledo (see overlay 567, perm 1/1/02)'
            ],
                [
                    'code' => 440,
                    'state_abbreviation' => 'OH',
                    'note' => 'Ohio: Cleveland metro area, excluding Cleveland (split from 216, see also 330)'
            ],
                [
                    'code' => 513,
                    'state_abbreviation' => 'OH',
                    'note' => 'SW Ohio: Cincinnati (see split 937; overlay 283 cancelled)'
            ],
                [
                    'code' => 567,
                    'state_abbreviation' => 'OH',
                    'note' => 'NW Ohio: Toledo (overlaid on 419, perm 1/1/02)'
            ],
                [
                    'code' => 614,
                    'state_abbreviation' => 'OH',
                    'note' => 'SE Ohio: Columbus (see overlay 380)'
            ],
                [
                    'code' => 740,
                    'state_abbreviation' => 'OH',
                    'note' => 'SE and Central Ohio (outside Columbus; split from 614; overlay 220)'
            ],
                [
                    'code' => 937,
                    'state_abbreviation' => 'OH',
                    'note' => 'SW Ohio: Dayton (part of what used to be 513)'
            ],
                [
                    'code' => 405,
                    'state_abbreviation' => 'OK',
                    'note' => 'W Oklahoma: Oklahoma City (see 580)'
            ],
                [
                    'code' => 539,
                    'state_abbreviation' => 'OK',
                    'note' => 'E Oklahoma: Tulsa area (overlaid on 918)'
            ],
                [
                    'code' => 580,
                    'state_abbreviation' => 'OK',
                    'note' => 'W Oklahoma (rural areas outside Oklahoma City; split from 405)'
            ],
                [
                    'code' => 918,
                    'state_abbreviation' => 'OK',
                    'note' => 'E Oklahoma: Tulsa (see overlay 539)'
            ],
                [
                    'code' => 458,
                    'state_abbreviation' => 'OR',
                    'note' => 'Oregon: Eugene, Medford (overlaid on 541)'
            ],
                [
                    'code' => 503,
                    'state_abbreviation' => 'OR',
                    'note' => 'Oregon (see 458, 541, 971)'
            ],
                [
                    'code' => 541,
                    'state_abbreviation' => 'OR',
                    'note' => 'Oregon: Eugene, Medford (split from 503; 503 retains NW part [Portland/Salem], all else moves to 541; eastern oregon is UTC-7).  Also serves small part of northern California (NE corner of Del Norte County).  (See overlay 458.)'
            ],
                [
                    'code' => 971,
                    'state_abbreviation' => 'OR',
                    'note' => 'Oregon:  Metropolitan Portland, Salem/Keizer area, incl Cricket Wireless (see 503; perm 10/1/00)'
            ],
                [
                    'code' => 215,
                    'state_abbreviation' => 'PA',
                    'note' => 'SE Pennsylvania: Philadelphia (see overlays 267)'
            ],
                [
                    'code' => 223,
                    'state_abbreviation' => 'PA',
                    'note' => 'E Pennsylvania: Gettysburg, Harrisburg, Lancaster, Lebanan, and York (overlays 223, eff 8/2017)'
            ],
                [
                    'code' => 267,
                    'state_abbreviation' => 'PA',
                    'note' => 'SE Pennsylvania: Philadelphia (see 215)'
            ],
                [
                    'code' => 272,
                    'state_abbreviation' => 'PA',
                    'note' => 'NE and N Central Pennsylvania: Wilkes-Barre, Scranton (see 717; overlaid on 570)'
            ],
                [
                    'code' => 412,
                    'state_abbreviation' => 'PA',
                    'note' => 'W Pennsylvania: Pittsburgh (see split 724, overlay 878)'
            ],
                [
                    'code' => 484,
                    'state_abbreviation' => 'PA',
                    'note' => 'SE Pennsylvania: Allentown, Bethlehem, Reading, West Chester, Norristown (see 610)'
            ],
                [
                    'code' => 570,
                    'state_abbreviation' => 'PA',
                    'note' => 'NE and N Central Pennsylvania: Wilkes-Barre, Scranton (see 717; see overlay 272)'
            ],
                [
                    'code' => 610,
                    'state_abbreviation' => 'PA',
                    'note' => 'SE Pennsylvania: Allentown, Bethlehem, Reading, West Chester, Norristown (see overlays 484, 835)'
            ],
                [
                    'code' => 717,
                    'state_abbreviation' => 'PA',
                    'note' => 'E Pennsylvania: Harrisburg (see split 570, overlay 223)'
            ],
                [
                    'code' => 724,
                    'state_abbreviation' => 'PA',
                    'note' => 'SW Pennsylvania (areas outside metro Pittsburgh; split from 412)'
            ],
                [
                    'code' => 814,
                    'state_abbreviation' => 'PA',
                    'note' => 'Cent. Pennsylvania: Erie'
            ],
                [
                    'code' => 835,
                    'state_abbreviation' => 'PA',
                    'note' => 'SE Pennsylvania: Allentown, Bethlehem, Reading, West Chester, Norristown (overlaid on 610, eff 5/1/01; see also 484)'
            ],
                [
                    'code' => 878,
                    'state_abbreviation' => 'PA',
                    'note' => 'Pittsburgh, New Castle (overlaid on 412, perm 8/17/01, mand t.b.a.)'
            ],
                [
                    'code' => 787,
                    'state_abbreviation' => 'PR',
                    'note' => 'Puerto Rico (see overlay 939, perm 8/1/01)'
            ],
                [
                    'code' => 939,
                    'state_abbreviation' => 'PR',
                    'note' => 'Puerto Rico (overlaid on 787, perm 8/1/01)'
            ],
                [
                    'code' => 401,
                    'state_abbreviation' => 'RI',
                    'note' => 'Rhode Island'
            ],
                [
                    'code' => 803,
                    'state_abbreviation' => 'SC',
                    'note' => 'South Carolina: Columbia, Aiken, Sumter (see 843, 864)'
            ],
                [
                    'code' => 843,
                    'state_abbreviation' => 'SC',
                    'note' => 'South Carolina, coastal area: Charleston, Beaufort, Myrtle Beach (split from 803)'
            ],
                [
                    'code' => 864,
                    'state_abbreviation' => 'SC',
                    'note' => 'South Carolina, upstate area: Greenville, Spartanburg (split from 803)'
            ],
                [
                    'code' => 605,
                    'state_abbreviation' => 'SD',
                    'note' => 'South Dakota'
            ],
                [
                    'code' => 423,
                    'state_abbreviation' => 'TN',
                    'note' => 'E Tennessee, except Knoxville metro area: Chattanooga, Bristol, Johnson City, Kingsport, Greeneville (see split 865; part of what used to be 615)'
            ],
                [
                    'code' => 615,
                    'state_abbreviation' => 'TN',
                    'note' => 'Northern Middle Tennessee: Nashville metro area (see 423, 931; see overlay 629, eff 2014)'
            ],
                [
                    'code' => 629,
                    'state_abbreviation' => 'TN',
                    'note' => 'Northern Middle Tennessee: Nashville metro area (see 423, 931; overlaid on 615, eff 2014)'
            ],
                [
                    'code' => 731,
                    'state_abbreviation' => 'TN',
                    'note' => 'W Tennessee: outside Memphis metro area (split from 901, perm 2/12/01, mand 9/17/01)'
            ],
                [
                    'code' => 865,
                    'state_abbreviation' => 'TN',
                    'note' => 'E Tennessee: Knoxville, Knox and adjacent counties (split from 423; part of what used to be 615)'
            ],
                [
                    'code' => 901,
                    'state_abbreviation' => 'TN',
                    'note' => 'W Tennessee: Memphis metro area (see 615, 931, split 731)'
            ],
                [
                    'code' => 931,
                    'state_abbreviation' => 'TN',
                    'note' => 'Middle Tennessee: semi-circular ring around Nashville (split from 615)'
            ],
                [
                    'code' => 210,
                    'state_abbreviation' => 'TX',
                    'note' => 'S Texas: San Antonio (see also splits 830, 956)'
            ],
                [
                    'code' => 214,
                    'state_abbreviation' => 'TX',
                    'note' => 'Texas: Dallas Metro (overlays 469/972)'
            ],
                [
                    'code' => 254,
                    'state_abbreviation' => 'TX',
                    'note' => 'Central Texas (Waco, Stephenville; split, see 817, 940)'
            ],
                [
                    'code' => 281,
                    'state_abbreviation' => 'TX',
                    'note' => 'Texas: Houston Metro (split 713; overlay 832, 346)'
            ],
                [
                    'code' => 325,
                    'state_abbreviation' => 'TX',
                    'note' => 'Central Texas: Abilene, Sweetwater, Snyder, San Angelo (split from 915)'
            ],
                [
                    'code' => 346,
                    'state_abbreviation' => 'TX',
                    'note' => 'Mid SE Texas: central Houston (overlaid on 713, 281, and 832)'
            ],
                [
                    'code' => 361,
                    'state_abbreviation' => 'TX',
                    'note' => 'S Texas: Corpus Christi (split from 512; eff 2/13/99)'
            ],
                [
                    'code' => 409,
                    'state_abbreviation' => 'TX',
                    'note' => 'SE Texas: Galveston, Port Arthur, Beaumont (splits 936, 979)'
            ],
                [
                    'code' => 430,
                    'state_abbreviation' => 'TX',
                    'note' => 'NE Texas: Tyler (overlaid on 903, eff 7/20/02)'
            ],
                [
                    'code' => 432,
                    'state_abbreviation' => 'TX',
                    'note' => 'W Texas: Big Spring, Midland, Odessa (split from 915, eff 4/5/03)'
            ],
                [
                    'code' => 469,
                    'state_abbreviation' => 'TX',
                    'note' => 'Texas: Dallas Metro (overlays 214/972)'
            ],
                [
                    'code' => 512,
                    'state_abbreviation' => 'TX',
                    'note' => 'S Texas: Austin (see split 361; overlay 737, perm 11/10/01)'
            ],
                [
                    'code' => 682,
                    'state_abbreviation' => 'TX',
                    'note' => 'Texas: Fort Worth areas (perm 10/7/00, mand 12/9/00)'
            ],
                [
                    'code' => 713,
                    'state_abbreviation' => 'TX',
                    'note' => 'Mid SE Texas: central Houston (split 281; overlay 346, 832)'
            ],
                [
                    'code' => 737,
                    'state_abbreviation' => 'TX',
                    'note' => 'S Texas: Austin (overlaid on 512, suspended; see also 361)'
            ],
                [
                    'code' => 806,
                    'state_abbreviation' => 'TX',
                    'note' => 'Panhandle Texas: Amarillo, Lubbock'
            ],
                [
                    'code' => 817,
                    'state_abbreviation' => 'TX',
                    'note' => 'N Cent. Texas: Fort Worth area (see 254, 940)'
            ],
                [
                    'code' => 830,
                    'state_abbreviation' => 'TX',
                    'note' => 'Texas: region surrounding San Antonio (split from 210)'
            ],
                [
                    'code' => 832,
                    'state_abbreviation' => 'TX',
                    'note' => 'Texas: Houston (overlay 713, 281, 346)'
            ],
                [
                    'code' => 903,
                    'state_abbreviation' => 'TX',
                    'note' => 'NE Texas: Tyler (see overlay 430, eff 7/20/02)'
            ],
                [
                    'code' => 915,
                    'state_abbreviation' => 'TX',
                    'note' => 'W Texas: El Paso (see splits 325 eff 4/5/03; 432, eff 4/5/03)'
            ],
                [
                    'code' => 936,
                    'state_abbreviation' => 'TX',
                    'note' => 'SE Texas: Conroe, Lufkin, Nacogdoches, Crockett (split from 409, see also 979)'
            ],
                [
                    'code' => 940,
                    'state_abbreviation' => 'TX',
                    'note' => 'N Cent. Texas: Denton, Wichita Falls (split from 254, 817)'
            ],
                [
                    'code' => 956,
                    'state_abbreviation' => 'TX',
                    'note' => 'Texas: Valley of Texas area; Harlingen, Laredo (split from 210)'
            ],
                [
                    'code' => 972,
                    'state_abbreviation' => 'TX',
                    'note' => 'Texas: Dallas Metro (overlays 214/469)'
            ],
                [
                    'code' => 979,
                    'state_abbreviation' => 'TX',
                    'note' => 'SE Texas: Bryan, College Station, Bay City (split from 409, see also 936)'
            ],
                [
                    'code' => 385,
                    'state_abbreviation' => 'UT',
                    'note' => 'Utah: Salt Lake City Metro (split from 801, eff 3/30/02 POSTPONED; see also 435)'
            ],
                [
                    'code' => 435,
                    'state_abbreviation' => 'UT',
                    'note' => 'Rural Utah outside Salt Lake City metro (see split 801)'
            ],
                [
                    'code' => 801,
                    'state_abbreviation' => 'UT',
                    'note' => 'Utah: Salt Lake City Metro (see split 385, eff 3/30/02; see also split 435)'
            ],
                [
                    'code' => 276,
                    'state_abbreviation' => 'VA',
                    'note' => 'S and SW Virginia: Bristol, Stuart, Martinsville (split from 540; perm 9/1/01, mand 3/16/02)'
            ],
                [
                    'code' => 434,
                    'state_abbreviation' => 'VA',
                    'note' => 'E Virginia: Charlottesville, Lynchburg, Danville, South Boston, and Emporia (split from 804, eff 6/1/01; see also 757)'
            ],
                [
                    'code' => 540,
                    'state_abbreviation' => 'VA',
                    'note' => 'Western and Southwest Virginia: Shenandoah and Roanoke valleys: Fredericksburg, Harrisonburg, Roanoke, Salem, Lexington and nearby areas (see split 276; split from 703)'
            ],
                [
                    'code' => 571,
                    'state_abbreviation' => 'VA',
                    'note' => 'Northern Virginia: Arlington, McLean, Tysons Corner (to be overlaid on 703 3/1/00; see earlier split 540)'
            ],
                [
                    'code' => 703,
                    'state_abbreviation' => 'VA',
                    'note' => 'Northern Virginia: Arlington, McLean, Tysons Corner (see split 540; overlay 571)'
            ],
                [
                    'code' => 757,
                    'state_abbreviation' => 'VA',
                    'note' => 'E Virginia: Tidewater / Hampton Roads area -- Norfolk, Virginia Beach, Chesapeake, Portsmouth, Hampton, Newport News, Suffolk (part of what used to be 804)'
            ],
                [
                    'code' => 804,
                    'state_abbreviation' => 'VA',
                    'note' => 'E Virginia: Richmond (see splits 757, 434)'
            ],
                [
                    'code' => 340,
                    'state_abbreviation' => 'VI',
                    'note' => 'US Virgin Islands (see also 809)'
            ],
                [
                    'code' => 802,
                    'state_abbreviation' => 'VT',
                    'note' => 'Vermont'
            ],
                [
                    'code' => 206,
                    'state_abbreviation' => 'WA',
                    'note' => 'W Washington state: Seattle and Bainbridge Island (see splits 253, 360, 425; overlay 564)'
            ],
                [
                    'code' => 253,
                    'state_abbreviation' => 'WA',
                    'note' => 'Washington: South Tier - Tacoma, Federal Way (split from 206, see also 425; overlay 564)'
            ],
                [
                    'code' => 360,
                    'state_abbreviation' => 'WA',
                    'note' => 'W Washington State: Olympia, Bellingham (area circling 206, 253, and 425; split from 206; see overlay 564)'
            ],
                [
                    'code' => 425,
                    'state_abbreviation' => 'WA',
                    'note' => 'Washington: North Tier - Everett, Bellevue (split from 206, see also 253; overlay 564)'
            ],
                [
                    'code' => 509,
                    'state_abbreviation' => 'WA',
                    'note' => 'E and Central Washington state: Spokane, Yakima, Walla Walla, Ellensburg'
            ],
                [
                    'code' => 564,
                    'state_abbreviation' => 'WA',
                    'note' => 'W Washington State: Olympia, Bellingham (overlaid on 360; see also 206, 253, 425; assigned but not in use)'
            ],
                [
                    'code' => 262,
                    'state_abbreviation' => 'WI',
                    'note' => 'SE Wisconsin: counties of Kenosha, Ozaukee, Racine, Walworth, Washington, Waukesha (split from 414)'
            ],
                [
                    'code' => 414,
                    'state_abbreviation' => 'WI',
                    'note' => 'SE Wisconsin: Milwaukee County (see splits 920, 262)'
            ],
                [
                    'code' => 608,
                    'state_abbreviation' => 'WI',
                    'note' => 'SW Wisconsin: Madison'
            ],
                [
                    'code' => 715,
                    'state_abbreviation' => 'WI',
                    'note' => 'N Wisconsin: Eau Claire, Wausau, Superior'
            ],
                [
                    'code' => 920,
                    'state_abbreviation' => 'WI',
                    'note' => 'NE Wisconsin: Appleton, Green Bay, Sheboygan, Fond du Lac (from Beaver Dam NE to Oshkosh, Appleton, and Door County; part of what used to be 414)'
            ],
                [
                    'code' => 304,
                    'state_abbreviation' => 'WV',
                    'note' => 'West Virginia (see overlay 681)'
            ],
                [
                    'code' => 681,
                    'state_abbreviation' => 'WV',
                    'note' => 'West Virginia (overlaid on 304)'
            ],
                [
                    'code' => 307,
                    'state_abbreviation' => 'WY',
                    'note' => 'Wyoming'
            ],
        ];

        $now = Carbon::now()->format('Y-m-d H:i:s');
        $phoneAreaRecords = collect($phoneAreaData)
            ->map(function (array $record) use ($now) {
                $stateId = State::fromAbbreviation($record['state_abbreviation'])->getId();
                unset($record['state_abbreviation']);
                return array_merge($record, [
                    'state_id' => $stateId,
                    'created_at' => $now,
                ]);
            })->toArray();

        PhoneArea::query()->insertOrIgnore($phoneAreaRecords);
    }

}
