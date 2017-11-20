<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('topics')->delete();
        
        \DB::table('topics')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'work',
                'type_id' => NULL,
                'parent_id' => NULL,
                'title' => 'My Work',
                'description' => NULL,
                'excerpt' => NULL,
                'image_id' => NULL,
                'icon_id' => NULL,
                'heroicon_id' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2017-11-10 21:48:05',
                'updated_at' => '2017-11-10 21:48:05',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'slug' => 'backend',
                'type_id' => NULL,
                'parent_id' => NULL,
                'title' => 'Backend Development',
                'description' => NULL,
                'excerpt' => NULL,
                'image_id' => NULL,
                'icon_id' => NULL,
                'heroicon_id' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2017-11-10 21:48:05',
                'updated_at' => '2017-11-10 21:48:05',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'slug' => 'frontend',
                'type_id' => NULL,
                'parent_id' => NULL,
                'title' => 'Frontend Development',
                'description' => NULL,
                'excerpt' => NULL,
                'image_id' => NULL,
                'icon_id' => NULL,
                'heroicon_id' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2017-11-10 21:48:05',
                'updated_at' => '2017-11-10 21:48:05',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'slug' => 'analytics',
                'type_id' => NULL,
                'parent_id' => NULL,
                'title' => 'Business Analytics',
                'description' => NULL,
                'excerpt' => NULL,
                'image_id' => NULL,
                'icon_id' => NULL,
                'heroicon_id' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2017-11-10 21:48:05',
                'updated_at' => '2017-11-10 21:48:05',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'slug' => 'marketing',
                'type_id' => NULL,
                'parent_id' => NULL,
                'title' => 'Digital Marketing',
                'description' => NULL,
                'excerpt' => NULL,
                'image_id' => NULL,
                'icon_id' => NULL,
                'heroicon_id' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2017-11-10 21:48:05',
                'updated_at' => '2017-11-10 21:48:05',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'slug' => 'tools',
                'type_id' => NULL,
                'parent_id' => NULL,
                'title' => 'Tools I Use',
                'description' => NULL,
                'excerpt' => NULL,
                'image_id' => NULL,
                'icon_id' => NULL,
                'heroicon_id' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2017-11-10 21:48:05',
                'updated_at' => '2017-11-10 21:48:05',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 20,
                'slug' => 'laravel',
                'type_id' => NULL,
                'parent_id' => 2,
                'title' => 'Laravel',
                'description' => NULL,
                'excerpt' => NULL,
                'image_id' => NULL,
                'icon_id' => NULL,
                'heroicon_id' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2017-11-10 21:48:05',
                'updated_at' => '2017-11-10 21:48:05',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}