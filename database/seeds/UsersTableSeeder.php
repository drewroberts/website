<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        DB::table('users')->insert([
            'username'      => 'DrewRoberts',
            'email'         => 'drew@drewroberts.com',
            'password'      => bcrypt('password'),
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
    }
}