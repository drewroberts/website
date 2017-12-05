<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Temporarily increase memory limit
        ini_set('memory_limit','20000000000000M');
        
        $this->call(UsersTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(MarketsTableSeeder::class);
        $this->call(ZipsTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
    }
}
