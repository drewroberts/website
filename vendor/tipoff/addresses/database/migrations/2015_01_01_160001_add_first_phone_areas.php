<?php

declare(strict_types = 1);

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Tipoff\Addresses\Models\PhoneArea;
use Tipoff\Addresses\Models\State;

class AddFirstPhoneAreas extends Migration {

    public function up() {

        $phoneAreaData = [
                [
                    'code' => 907,
                    'state_abbreviation' => 'AK',
                    'note' => 'Alaska'
            ],
                [
                    'code' => 205,
                    'state_abbreviation' => 'AL',
                    'note' => 'Central Alabama (including Birmingham; excludes the southeastern corner of Alabama and the deep south; see splits 256 and 334)'
            ],
                [
                    'code' => 251,
                    'state_abbreviation' => 'AL',
                    'note' => 'S Alabama: Mobile and coastal areas, Jackson, Evergreen, Monroeville (split from 334, eff 6/18/01; see also 205, 256)'
            ],
                [
                    'code' => 256,
                    'state_abbreviation' => 'AL',
                    'note' => 'E and N Alabama (Huntsville, Florence, Gadsden; split from 205; see also 334)'
            ],
                [
                    'code' => 334,
                    'state_abbreviation' => 'AL',
                    'note' => 'S Alabama: Auburn/Opelika, Montgomery and coastal areas (part of what used to be 205; see also 256, split 251)'
            ],
                [
                    'code' => 479,
                    'state_abbreviation' => 'AR',
                    'note' => 'NW Arkansas:  Fort Smith, Fayetteville, Springdale, Bentonville (SPLIt from 501, perm 1/19/02, mand 7/20/02)'
            ],
                [
                    'code' => 501,
                    'state_abbreviation' => 'AR',
                    'note' => 'Central Arkansas: Little Rock, Hot Springs, Conway (see split 479)'
            ],
                [
                    'code' => 870,
                    'state_abbreviation' => 'AR',
                    'note' => 'Arkansas: areas outside of west/central AR: Jonesboro, etc'
            ],
                [
                    'code' => 480,
                    'state_abbreviation' => 'AZ',
                    'note' => 'Arizona: East Phoenix (see 520; also Phoenix split 602, 623)'
            ],
                [
                    'code' => 520,
                    'state_abbreviation' => 'AZ',
                    'note' => 'SE Arizona: Tucson area (split from 602; see split 928)'
            ],
                [
                    'code' => 602,
                    'state_abbreviation' => 'AZ',
                    'note' => 'Arizona: Phoenix (see 520; also Phoenix split 480, 623)'
            ],
                [
                    'code' => 623,
                    'state_abbreviation' => 'AZ',
                    'note' => 'Arizona: West Phoenix (see 520; also Phoenix split 480, 602)'
            ],
                [
                    'code' => 928,
                    'state_abbreviation' => 'AZ',
                    'note' => 'Central and Northern Arizona: Prescott, Flagstaff, Yuma (split from 520)'
            ],
                [
                    'code' => 209,
                    'state_abbreviation' => 'CA',
                    'note' => 'Cent. California: Stockton (see split 559)'
            ],
                [
                    'code' => 213,
                    'state_abbreviation' => 'CA',
                    'note' => 'S California: Los Angeles (see 310, 323, 626, 818)'
            ],
                [
                    'code' => 310,
                    'state_abbreviation' => 'CA',
                    'note' => 'S California: Beverly Hills, West Hollywood, West Los Angeles (see split 562; overlay 424)'
            ],
                [
                    'code' => 323,
                    'state_abbreviation' => 'CA',
                    'note' => 'S California: Los Angeles (outside downtown: Hollywood; split from 213)'
            ],
                [
                    'code' => 341,
                    'state_abbreviation' => 'CA',
                    'note' => '(overlay on 510; SUSPENDED)'
            ],
                [
                    'code' => 369,
                    'state_abbreviation' => 'CA',
                    'note' => 'Solano County (perm 12/2/00, mand 6/2/01)'
            ],
                [
                    'code' => 408,
                    'state_abbreviation' => 'CA',
                    'note' => 'Cent. Coastal California: San Jose (see overlay 669)'
            ],
                [
                    'code' => 415,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: San Francisco County and Marin County on the north side of the Golden Gate Bridge, extending north to Sonoma County (see 650 split; 628 overlay, eff 2/2015)'
            ],
                [
                    'code' => 424,
                    'state_abbreviation' => 'CA',
                    'note' => 'S California: Los Angeles (see split 562; overlaid on 310 mand 7/26/06)'
            ],
                [
                    'code' => 442,
                    'state_abbreviation' => 'CA',
                    'note' => 'Far north suburbs of San Diego (Oceanside, Escondido; overlaid on 760)'
            ],
                [
                    'code' => 510,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: Oakland, East Bay (see 925)'
            ],
                [
                    'code' => 530,
                    'state_abbreviation' => 'CA',
                    'note' => 'NE California: Eldorado County area, excluding Eldorado Hills itself: incl cities of Auburn, Chico, Redding, So. Lake Tahoe, Marysville, Nevada City/Grass Valley (split from 916)'
            ],
                [
                    'code' => 559,
                    'state_abbreviation' => 'CA',
                    'note' => 'Central California: Fresno (split from 209)'
            ],
                [
                    'code' => 562,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: Long Beach (split from 310 Los Angeles)'
            ],
                [
                    'code' => 619,
                    'state_abbreviation' => 'CA',
                    'note' => 'S California: San Diego (see split 760; overlay 858, 935)'
            ],
                [
                    'code' => 626,
                    'state_abbreviation' => 'CA',
                    'note' => 'E S California: Pasadena (split from 818 Los Angeles)'
            ],
                [
                    'code' => 627,
                    'state_abbreviation' => 'CA',
                    'note' => 'No longer in use [was Napa, Sonoma counties (perm 10/13/01, mand 4/13/02); now 707]'
            ],
                [
                    'code' => 628,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: San Francisco County and Marin County on the north side of the Golden Gate Bridge, extending north to Sonoma County (overlaid on 415, eff 2/2015)'
            ],
                [
                    'code' => 650,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: Peninsula south of San Francisco -- San Mateo County, parts of Santa Clara County (split from 415)'
            ],
                [
                    'code' => 657,
                    'state_abbreviation' => 'CA',
                    'note' => 'Northern and western Orange County (overlaid on 714)'
            ],
                [
                    'code' => 661,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: N Los Angeles, Mckittrick, Mojave, Newhall, Oildale, Palmdale, Taft, Tehachapi, Bakersfield, Earlimart, Lancaster (split from 805)'
            ],
                [
                    'code' => 669,
                    'state_abbreviation' => 'CA',
                    'note' => 'Cent. Coastal California: San Jose (overlaid on 408; eff 10/20/2012)'
            ],
                [
                    'code' => 707,
                    'state_abbreviation' => 'CA',
                    'note' => 'NW California: Santa Rosa, Napa, Vallejo, American Canyon, Fairfield'
            ],
                [
                    'code' => 714,
                    'state_abbreviation' => 'CA',
                    'note' => 'Northern and western Orange County (see split 949, overlay 657)'
            ],
                [
                    'code' => 747,
                    'state_abbreviation' => 'CA',
                    'note' => 'S California: Los Angeles, Agoura Hills, Calabasas, Hidden Hills, and Westlake Village (see 818; implementation suspended)'
            ],
                [
                    'code' => 760,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: San Diego North County to Sierra Nevada (split from 619; see overlay 442)'
            ],
                [
                    'code' => 764,
                    'state_abbreviation' => 'CA',
                    'note' => '(overlay on 650; SUSPENDED)'
            ],
                [
                    'code' => 805,
                    'state_abbreviation' => 'CA',
                    'note' => 'S Cent. and Cent. Coastal California: Ventura County, Santa Barbara County: San Luis Obispo, Thousand Oaks, Carpinteria, Santa Barbara, Santa Maria, Lompoc, Santa Ynez Valley / Solvang (see 661 split)'
            ],
                [
                    'code' => 818,
                    'state_abbreviation' => 'CA',
                    'note' => 'S California: Los Angeles: San Fernando Valley (see 213, 310, 562, 626, 747)'
            ],
                [
                    'code' => 831,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: central coast area from Santa Cruz through Monterey County'
            ],
                [
                    'code' => 858,
                    'state_abbreviation' => 'CA',
                    'note' => 'S California: San Diego (see split 760; overlay 619, 935)'
            ],
                [
                    'code' => 909,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: Inland empire: San Bernardino (see split 951), Riverside'
            ],
                [
                    'code' => 916,
                    'state_abbreviation' => 'CA',
                    'note' => 'NE California: Sacramento, Walnut Grove, Lincoln, Newcastle and El Dorado Hills (split to 530)'
            ],
                [
                    'code' => 925,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: Contra Costa area: Antioch, Concord, Pleasanton, Walnut Creek (split from 510)'
            ],
                [
                    'code' => 935,
                    'state_abbreviation' => 'CA',
                    'note' => 'S California: San Diego (see split 760; overlay 858, 619; assigned but not in use)'
            ],
                [
                    'code' => 949,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: S Coastal Orange County (split from 714)'
            ],
                [
                    'code' => 951,
                    'state_abbreviation' => 'CA',
                    'note' => 'California: W Riverside County (split from 909; eff 7/17/04)'
            ],
                [
                    'code' => 303,
                    'state_abbreviation' => 'CO',
                    'note' => 'Central Colorado: Denver (see 970, also 720 overlay)'
            ],
                [
                    'code' => 719,
                    'state_abbreviation' => 'CO',
                    'note' => 'SE Colorado: Pueblo, Colorado Springs'
            ],
                [
                    'code' => 720,
                    'state_abbreviation' => 'CO',
                    'note' => 'Central Colorado: Denver (overlaid on 303)'
            ],
                [
                    'code' => 970,
                    'state_abbreviation' => 'CO',
                    'note' => 'N and W Colorado (part of what used to be 303)'
            ],
                [
                    'code' => 203,
                    'state_abbreviation' => 'CT',
                    'note' => 'Connecticut: Fairfield County and New Haven County; Bridgeport, New Haven (see 860)'
            ],
                [
                    'code' => 475,
                    'state_abbreviation' => 'CT',
                    'note' => 'Connecticut: New Haven, Greenwich, southwestern (postponed; was perm 1/6/01; mand 3/1/01???)'
            ],
                [
                    'code' => 860,
                    'state_abbreviation' => 'CT',
                    'note' => 'Connecticut: areas outside of Fairfield and New Haven Counties (split from 203, overlay 959)'
            ],
                [
                    'code' => 959,
                    'state_abbreviation' => 'CT',
                    'note' => 'Connecticut: Hartford, New London (postponed; was overlaid on 860 perm 1/6/01; mand 3/1/01???)'
            ],
                [
                    'code' => 202,
                    'state_abbreviation' => 'DC',
                    'note' => 'Washington, D.C.'
            ],
                [
                    'code' => 302,
                    'state_abbreviation' => 'DE',
                    'note' => 'Delaware'
            ],
                [
                    'code' => 239,
                    'state_abbreviation' => 'FL',
                    'note' => 'Florida (Lee, Collier, and Monroe Counties, excl the Keys; see 305; eff 3/11/02; mand 3/11/03)'
            ],
                [
                    'code' => 305,
                    'state_abbreviation' => 'FL',
                    'note' => 'SE Florida: Miami, the Keys (see 786, 954; 239)'
            ],
                [
                    'code' => 321,
                    'state_abbreviation' => 'FL',
                    'note' => 'Florida: Brevard County, Cape Canaveral area; Metro Orlando (split from 407)'
            ],
                [
                    'code' => 352,
                    'state_abbreviation' => 'FL',
                    'note' => 'Florida: Gainesville area, Ocala, Crystal River (split from 904)'
            ],
                [
                    'code' => 386,
                    'state_abbreviation' => 'FL',
                    'note' => 'N central Florida: Lake City (split from 904, perm 2/15/01, mand 11/5/01)'
            ],
                [
                    'code' => 407,
                    'state_abbreviation' => 'FL',
                    'note' => 'Central Florida: Metro Orlando (see overlay 689, eff 7/02; split 321)'
            ],
                [
                    'code' => 561,
                    'state_abbreviation' => 'FL',
                    'note' => 'S. Central Florida: Palm Beach County (West Palm Beach, Boca Raton, Vero Beach; see split 772, eff 2/11/02; mand 11/11/02)'
            ],
                [
                    'code' => 689,
                    'state_abbreviation' => 'FL',
                    'note' => 'Central Florida: Metro Orlando (see overlay 321; overlaid on 407, assigned but not in use)'
            ],
                [
                    'code' => 727,
                    'state_abbreviation' => 'FL',
                    'note' => 'Florida Tampa Metro: Saint Petersburg, Clearwater (Pinellas and parts of Pasco County; split from 813)'
            ],
                [
                    'code' => 754,
                    'state_abbreviation' => 'FL',
                    'note' => 'Florida: Broward County area, incl Ft. Lauderdale (overlaid on 954; perm 8/1/01, mand 9/1/01)'
            ],
                [
                    'code' => 772,
                    'state_abbreviation' => 'FL',
                    'note' => 'S. Central Florida: St. Lucie, Martin, and Indian River counties (split from 561; eff 2/11/02; mand 11/11/02)'
            ],
                [
                    'code' => 786,
                    'state_abbreviation' => 'FL',
                    'note' => 'SE Florida, Monroe County (Miami; overlaid on 305)'
            ],
                [
                    'code' => 813,
                    'state_abbreviation' => 'FL',
                    'note' => 'SW Florida: Tampa Metro (splits 727 St. Petersburg, Clearwater, and 941 Sarasota)'
            ],
                [
                    'code' => 850,
                    'state_abbreviation' => 'FL',
                    'note' => 'Florida panhandle, from east of Tallahassee to Pensacola (split from 904); western panhandle (Pensacola, Panama City) are UTC-6'
            ],
                [
                    'code' => 863,
                    'state_abbreviation' => 'FL',
                    'note' => 'Florida: Lakeland, Polk County (split from 941)'
            ],
                [
                    'code' => 904,
                    'state_abbreviation' => 'FL',
                    'note' => 'N Florida: Jacksonville (see splits 352, 386, 850)'
            ],
                [
                    'code' => 927,
                    'state_abbreviation' => 'FL',
                    'note' => 'Florida: Cellular coverage in Orlando area'
            ],
                [
                    'code' => 941,
                    'state_abbreviation' => 'FL',
                    'note' => 'SW Florida: Sarasota and Manatee counties (part of what used to be 813; see split 863)'
            ],
                [
                    'code' => 954,
                    'state_abbreviation' => 'FL',
                    'note' => 'Florida: Broward County area, incl Ft. Lauderdale (part of what used to be 305, see overlay 754)'
            ],
                [
                    'code' => 229,
                    'state_abbreviation' => 'GA',
                    'note' => 'SW Georgia: Albany (split from 912; see also 478; perm 8/1/00)'
            ],
                [
                    'code' => 404,
                    'state_abbreviation' => 'GA',
                    'note' => 'N Georgia: Atlanta and suburbs (see overlay 678, split 770)'
            ],
                [
                    'code' => 470,
                    'state_abbreviation' => 'GA',
                    'note' => 'Georgia: Greater Atlanta Metropolitan Area (overlaid on 404/770/678; mand 9/2/01)'
            ],
                [
                    'code' => 478,
                    'state_abbreviation' => 'GA',
                    'note' => 'Central Georgia: Macon (split from 912; see also 229; perm 8/1/00; mand 8/1/01)'
            ],
                [
                    'code' => 678,
                    'state_abbreviation' => 'GA',
                    'note' => 'N Georgia: metropolitan Atlanta (overlay; see 404, 770)'
            ],
                [
                    'code' => 706,
                    'state_abbreviation' => 'GA',
                    'note' => 'N Georgia: Columbus, Augusta (see overlay 762)'
            ],
                [
                    'code' => 762,
                    'state_abbreviation' => 'GA',
                    'note' => 'N Georgia: Columbus, Augusta (overlaid on 706)'
            ],
                [
                    'code' => 770,
                    'state_abbreviation' => 'GA',
                    'note' => 'Georgia: Atlanta suburbs: outside of I-285 ring road (part of what used to be 404; see also overlay 678)'
            ],
                [
                    'code' => 912,
                    'state_abbreviation' => 'GA',
                    'note' => 'SE Georgia: Savannah (see splits 229, 478)'
            ],
                [
                    'code' => 671,
                    'state_abbreviation' => 'GU',
                    'note' => 'Guam'
            ],
                [
                    'code' => 808,
                    'state_abbreviation' => 'HI',
                    'note' => 'Hawaii'
            ],
                [
                    'code' => 319,
                    'state_abbreviation' => 'IA',
                    'note' => 'E Iowa: Cedar Rapids (see split 563)'
            ],
                [
                    'code' => 515,
                    'state_abbreviation' => 'IA',
                    'note' => 'Cent. Iowa: Des Moines (see split 641)'
            ],
                [
                    'code' => 563,
                    'state_abbreviation' => 'IA',
                    'note' => 'E Iowa: Davenport, Dubuque (split from 319, eff 3/25/01)'
            ],
                [
                    'code' => 641,
                    'state_abbreviation' => 'IA',
                    'note' => 'Iowa: Mason City, Marshalltown, Creston, Ottumwa (split from 515; perm 7/9/00)'
            ],
                [
                    'code' => 712,
                    'state_abbreviation' => 'IA',
                    'note' => 'W Iowa: Council Bluffs'
            ],
                [
                    'code' => 208,
                    'state_abbreviation' => 'ID',
                    'note' => 'Idaho'
            ],
                [
                    'code' => 217,
                    'state_abbreviation' => 'IL',
                    'note' => 'Cent. Illinois: Springfield'
            ],
                [
                    'code' => 224,
                    'state_abbreviation' => 'IL',
                    'note' => 'Northern NE Illinois:  Evanston, Waukegan, Northbrook (overlay on 847, eff 1/5/02)'
            ],
                [
                    'code' => 309,
                    'state_abbreviation' => 'IL',
                    'note' => 'W Cent. Illinois: Peoria'
            ],
                [
                    'code' => 312,
                    'state_abbreviation' => 'IL',
                    'note' => 'Illinois: Chicago (downtown only -- in the loop; see 773; overlay 872)'
            ],
                [
                    'code' => 331,
                    'state_abbreviation' => 'IL',
                    'note' => 'W NE Illinois, western suburbs of Chicago (part of what used to be 708; overlaid on 630; eff 7/07)'
            ],
                [
                    'code' => 464,
                    'state_abbreviation' => 'IL',
                    'note' => 'Illinois: south suburbs of Chicago (see 630; overlaid on 708)'
            ],
                [
                    'code' => 618,
                    'state_abbreviation' => 'IL',
                    'note' => 'S Illinois: Centralia'
            ],
                [
                    'code' => 630,
                    'state_abbreviation' => 'IL',
                    'note' => 'W NE Illinois, western suburbs of Chicago (part of what used to be 708; overlay 331)'
            ],
                [
                    'code' => 708,
                    'state_abbreviation' => 'IL',
                    'note' => 'Illinois: southern and western suburbs of Chicago (see 630; overlay 464)'
            ],
                [
                    'code' => 773,
                    'state_abbreviation' => 'IL',
                    'note' => 'Illinois: city of Chicago, outside the loop (see 312; overlay 872)'
            ],
                [
                    'code' => 779,
                    'state_abbreviation' => 'IL',
                    'note' => 'NW Illinois: Rockford, Kankakee (overlaid on 815; eff 8/19/06, mand 2/17/07)'
            ],
                [
                    'code' => 815,
                    'state_abbreviation' => 'IL',
                    'note' => 'NW Illinois: Rockford, Kankakee (see overlay 779; eff 8/19/06, mand 2/17/07)'
            ],
                [
                    'code' => 847,
                    'state_abbreviation' => 'IL',
                    'note' => 'Northern NE Illinois: northwestern suburbs of chicago (Evanston, Waukegan, Northbrook; see overlay 224)'
            ],
                [
                    'code' => 872,
                    'state_abbreviation' => 'IL',
                    'note' => 'Illinois: Chicago (downtown only -- in the loop; see 773; overlaid on 312 and 773)'
            ],
                [
                    'code' => 219,
                    'state_abbreviation' => 'IN',
                    'note' => 'NW Indiana: Gary (see split 574, 260)'
            ],
                [
                    'code' => 260,
                    'state_abbreviation' => 'IN',
                    'note' => 'NE Indiana: Fort Wayne (see 219)'
            ],
                [
                    'code' => 317,
                    'state_abbreviation' => 'IN',
                    'note' => 'Cent. Indiana: Indianapolis (see 765)'
            ],
                [
                    'code' => 574,
                    'state_abbreviation' => 'IN',
                    'note' => 'N Indiana: Elkhart, South Bend (split from 219)'
            ],
                [
                    'code' => 765,
                    'state_abbreviation' => 'IN',
                    'note' => 'Indiana: outside Indianapolis (split from 317)'
            ],
                [
                    'code' => 812,
                    'state_abbreviation' => 'IN',
                    'note' => 'S Indiana: Evansville, Cincinnati outskirts in IN, Columbus, Bloomington (mostly GMT-5)'
            ],
                [
                    'code' => 316,
                    'state_abbreviation' => 'KS',
                    'note' => 'S Kansas: Wichita (see split 620)'
            ],
                [
                    'code' => 620,
                    'state_abbreviation' => 'KS',
                    'note' => 'S Kansas: Wichita (split from 316; perm 2/3/01)'
            ],
                [
                    'code' => 785,
                    'state_abbreviation' => 'KS',
                    'note' => 'N & W Kansas: Topeka (split from 913)'
            ],
                [
                    'code' => 913,
                    'state_abbreviation' => 'KS',
                    'note' => 'Kansas: Kansas City area (see 785)'
            ],
                [
                    'code' => 270,
                    'state_abbreviation' => 'KY',
                    'note' => 'W Kentucky: Bowling Green, Paducah (split from 502)'
            ],
                [
                    'code' => 502,
                    'state_abbreviation' => 'KY',
                    'note' => 'N Central Kentucky: Louisville (see 270)'
            ],
                [
                    'code' => 606,
                    'state_abbreviation' => 'KY',
                    'note' => 'E Kentucky: area east of Frankfort: Ashland (see 859)'
            ],
                [
                    'code' => 859,
                    'state_abbreviation' => 'KY',
                    'note' => 'N and Central Kentucky: Lexington; suburban KY counties of Cincinnati OH metro area; Covington, Newport, Ft. Thomas, Ft. Wright, Florence (split from 606)'
            ],
                [
                    'code' => 225,
                    'state_abbreviation' => 'LA',
                    'note' => 'Louisiana: Baton Rouge, New Roads, Donaldsonville, Albany, Gonzales, Greensburg, Plaquemine, Vacherie (split from 504)'
            ],
                [
                    'code' => 318,
                    'state_abbreviation' => 'LA',
                    'note' => 'N Louisiana: Shreveport, Ruston, Monroe, Alexandria (see split 337)'
            ],
                [
                    'code' => 337,
                    'state_abbreviation' => 'LA',
                    'note' => 'SW Louisiana: Lake Charles, Lafayette (see split 318)'
            ],
                [
                    'code' => 504,
                    'state_abbreviation' => 'LA',
                    'note' => 'E Louisiana: New Orleans metro area (see splits 225, 985)'
            ],
                [
                    'code' => 985,
                    'state_abbreviation' => 'LA',
                    'note' => 'E Louisiana: SE/N shore of Lake Pontchartrain: Hammond, Slidell, Covington, Amite, Kentwood, area SW of New Orleans, Houma, Thibodaux, Morgan City (split from 504; perm 2/12/01; mand 10/22/01)'
            ],
                [
                    'code' => 339,
                    'state_abbreviation' => 'MA',
                    'note' => 'Massachusetts: Boston suburbs, to the south and west (see splits 617, 508; overlaid on 781, eff 5/2/01)'
            ],
                [
                    'code' => 351,
                    'state_abbreviation' => 'MA',
                    'note' => 'Massachusetts: north of Boston to NH, 508, and 781 (overlaid on 978, eff 4/2/01)'
            ],
                [
                    'code' => 413,
                    'state_abbreviation' => 'MA',
                    'note' => 'W Massachusetts: Springfield'
            ],
                [
                    'code' => 508,
                    'state_abbreviation' => 'MA',
                    'note' => 'Cent. Massachusetts: Framingham; Cape Cod (see split 978, overlay 774)'
            ],
                [
                    'code' => 617,
                    'state_abbreviation' => 'MA',
                    'note' => 'Massachusetts: greater Boston (see overlay 857)'
            ],
                [
                    'code' => 774,
                    'state_abbreviation' => 'MA',
                    'note' => 'Cent. Massachusetts: Framingham; Cape Cod (see split 978, overlaid on 508, eff 4/2/01)'
            ],
                [
                    'code' => 781,
                    'state_abbreviation' => 'MA',
                    'note' => 'Massachusetts: Boston surburbs, to the north and west (see splits 617, 508; overlay 339)'
            ],
                [
                    'code' => 857,
                    'state_abbreviation' => 'MA',
                    'note' => 'Massachusetts: greater Boston (overlaid on 617, eff 4/2/01)'
            ],
                [
                    'code' => 978,
                    'state_abbreviation' => 'MA',
                    'note' => 'Massachusetts: north of Boston to NH (see split 978 -- this is the northern half of old 508; see overlay 351)'
            ],
                [
                    'code' => 240,
                    'state_abbreviation' => 'MD',
                    'note' => 'W Maryland: Silver Spring, Frederick, Gaithersburg (overlay, see 301)'
            ],
                [
                    'code' => 301,
                    'state_abbreviation' => 'MD',
                    'note' => 'W Maryland: Silver Spring, Frederick, Camp Springs, Prince George\'s County (see 240)'
            ],
                [
                    'code' => 410,
                    'state_abbreviation' => 'MD',
                    'note' => 'E Maryland: Baltimore, Annapolis, Chesapeake Bay area, Ocean City (see overlays 443, 667)'
            ],
                [
                    'code' => 443,
                    'state_abbreviation' => 'MD',
                    'note' => 'E Maryland: Baltimore, Annapolis, Chesapeake Bay area, Ocean City (overlaid on 410, see overlay 667)'
            ],
                [
                    'code' => 667,
                    'state_abbreviation' => 'MD',
                    'note' => 'E Maryland: Baltimore, Annapolis, Chesapeake Bay area, Ocean City (overlaid on 410, 443)'
            ],
                [
                    'code' => 207,
                    'state_abbreviation' => 'ME',
                    'note' => 'Maine'
            ],
                [
                    'code' => 231,
                    'state_abbreviation' => 'MI',
                    'note' => 'W Michigan: Northwestern portion of lower Peninsula; Traverse City, Muskegon, Cheboygan, Alanson'
            ],
                [
                    'code' => 248,
                    'state_abbreviation' => 'MI',
                    'note' => 'Michigan: Oakland County, Pontiac (split from 810; see overlay 947)'
            ],
                [
                    'code' => 269,
                    'state_abbreviation' => 'MI',
                    'note' => 'SW Michigan: Kalamazoo, Saugatuck, Hastings, Battle Creek, Sturgis to Lake Michigan (split from 616)'
            ],
                [
                    'code' => 278,
                    'state_abbreviation' => 'MI',
                    'note' => 'Michigan (overlaid on 734, SUSPENDED)'
            ],
                [
                    'code' => 313,
                    'state_abbreviation' => 'MI',
                    'note' => 'Michigan: Detroit and suburbs (see 734, overlay 679)'
            ],
                [
                    'code' => 517,
                    'state_abbreviation' => 'MI',
                    'note' => 'Cent. Michigan: Lansing (see split 989)'
            ],
                [
                    'code' => 586,
                    'state_abbreviation' => 'MI',
                    'note' => 'Michigan: Macomb County (split from 810; perm 9/22/01, mand 3/23/02)'
            ],
                [
                    'code' => 616,
                    'state_abbreviation' => 'MI',
                    'note' => 'W Michigan: Holland, Grand Haven, Greenville, Grand Rapids, Ionia (see split 269)'
            ],
                [
                    'code' => 679,
                    'state_abbreviation' => 'MI',
                    'note' => 'Michigan: Dearborn area (overlaid on 313; assigned but not in use)'
            ],
                [
                    'code' => 734,
                    'state_abbreviation' => 'MI',
                    'note' => 'SE Michigan: west and south of Detroit -- Ann Arbor, Monroe (split from 313)'
            ],
                [
                    'code' => 810,
                    'state_abbreviation' => 'MI',
                    'note' => 'E Michigan: Flint, Pontiac (see 248; split 586)'
            ],
                [
                    'code' => 906,
                    'state_abbreviation' => 'MI',
                    'note' => 'Upper Peninsula Michigan: Sault Ste. Marie, Escanaba, Marquette (UTC-6 towards the WI border)'
            ],
                [
                    'code' => 947,
                    'state_abbreviation' => 'MI',
                    'note' => 'Michigan: Oakland County (overlays 248, perm 5/5/01)'
            ],
                [
                    'code' => 989,
                    'state_abbreviation' => 'MI',
                    'note' => 'Upper central Michigan: Mt Pleasant, Saginaw (split from 517; perm 4/7/01)'
            ],
                [
                    'code' => 218,
                    'state_abbreviation' => 'MN',
                    'note' => 'N Minnesota: Duluth'
            ],
                [
                    'code' => 320,
                    'state_abbreviation' => 'MN',
                    'note' => 'Cent. Minnesota: Saint Cloud (rural Minn, excl St. Paul/Minneapolis)'
            ],
                [
                    'code' => 507,
                    'state_abbreviation' => 'MN',
                    'note' => 'S Minnesota: Rochester, Mankato, Worthington'
            ]
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
