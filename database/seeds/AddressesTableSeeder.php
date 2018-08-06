<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('addresses')->delete();

        \DB::table('addresses')->insert(array (
            0 =>
            array (
                'id' => 1,
                'addressable_type' => 'Users',
                'addressable_id' => 1,
                'type_id' => NULL,
                'market_id' => 3,
                'address' => '237 Ridgewood St',
                'address_line_2' => NULL,
                'city' => 'Altamonte Springs',
                'state_id' => 1,
                'zip_code' => 32701,
                'zip_extension' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2017-11-13 08:57:47',
                'updated_at' => '2017-11-13 08:57:47',
            ),
        ));
    }
}
