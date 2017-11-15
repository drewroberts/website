<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('profiles')->delete();
        
        \DB::table('profiles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'first_name' => 'Drew',
                'last_name' => 'Roberts',
                'display_name' => 'Drew Roberts',
                'avatar_id' => NULL,
                'cover_id' => NULL,
                'gender' => 'M',
                'prefix' => NULL,
                'suffix' => NULL,
                'title' => 'CEO',
                'tagline' => NULL,
                'phone' => NULL,
                'billing_id' => NULL,
                'mailing_id' => NULL,
                'twitter' => 'DrewRoberts',
                'facebook' => 'DrewRoberts',
                'instagram' => NULL,
                'linkedin' => 'DrewRoberts',
                'snapchat' => NULL,
                'github' => 'DrewRoberts',
                'birth' => '1983-05-20',
                'last_read_announcements_at' => NULL,
                'created_at' => '2017-11-13 09:54:29',
                'updated_at' => '2017-11-13 09:54:29',
            ),
        ));
        
        
    }
}