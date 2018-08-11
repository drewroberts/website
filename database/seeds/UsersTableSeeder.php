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
            'name'          => 'Drew Roberts',
            'email'         => 'drew@drewroberts.com',
            'username'      => 'DrewRoberts',
            'password'      => bcrypt('password'),
            'id_token'      => NULL,
            'created_at'    => $now,
            'updated_at'    => $now,
            'verified_at'   => $now,
        ]);
    }
}
