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

        \DB::table('profiles')->insert(array(
            0 =>
            array(
                'id' => 1,
                'user_id' => 1,
                'first_name' => 'Drew',
                'last_name' => 'Roberts',
                'display_name' => 'Drew Roberts',
                'avatar_id' => null,
                'cover_id' => null,
                'gender' => 'M',
                'prefix' => null,
                'suffix' => null,
                'title' => 'CEO',
                'tagline' => null,
                'phone' => null,
                'billing_id' => 1,
                'mailing_id' => 1,
                'website_personal' => 'https://drewroberts.com',
                'website_work' => 'https://tipoff.com',
                'website_work2' => null,
                'website_work3' => null,
                'twitter' => 'DrewRoberts',
                'facebook' => 'DrewRoberts',
                'instagram' => null,
                'linkedin' => 'DrewRoberts',
                'github' => 'DrewRoberts',
                'googleplus' => 'DrewRoberts',
                'youtube' => 'DrewRoberts',
                'birth' => '1983-05-20',
                'last_read_announcements_at' => null,
                'created_at' => '2017-11-13 09:54:29',
                'updated_at' => '2017-11-13 09:54:29',
            ),
        ));
    }
}
