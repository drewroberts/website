<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('types')->delete();

      \DB::table('types')->insert(array (
          0 =>
          array (
              'id' => 1,
              'table' => 'posts',
              'slug' => 'about',
              'title' => 'About Me',
              'parent_id' => NULL,
              'description' => NULL,
              'note' => NULL,
              'width' => NULL,
              'height' => NULL,
              'path' => NULL,
              'source' => NULL,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => NULL,
          ),
          1 =>
          array (
              'id' => 2,
              'table' => 'posts',
              'slug' => 'interviews',
              'title' => 'Interviews',
              'parent_id' => NULL,
              'description' => NULL,
              'note' => NULL,
              'width' => NULL,
              'height' => NULL,
              'path' => NULL,
              'source' => NULL,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => NULL,
          ),
          2 =>
          array (
              'id' => 3,
              'table' => 'posts',
              'slug' => 'projects',
              'title' => 'Projects',
              'parent_id' => NULL,
              'description' => NULL,
              'note' => NULL,
              'width' => NULL,
              'height' => NULL,
              'path' => NULL,
              'source' => NULL,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => NULL,
          ),
          3 =>
          array (
              'id' => 4,
              'table' => 'posts',
              'slug' => 'tutorials',
              'title' => 'Tutorials',
              'parent_id' => NULL,
              'description' => NULL,
              'note' => NULL,
              'width' => NULL,
              'height' => NULL,
              'path' => NULL,
              'source' => NULL,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => NULL,
          ),
          4 =>
          array (
              'id' => 5,
              'table' => 'posts',
              'slug' => 'articles',
              'title' => 'Articles',
              'parent_id' => NULL,
              'description' => NULL,
              'note' => NULL,
              'width' => NULL,
              'height' => NULL,
              'path' => NULL,
              'source' => NULL,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => NULL,
          ),
          5 =>
          array (
              'id' => 6,
              'table' => 'posts',
              'slug' => 'tips',
              'title' => 'Quick Tips / Short Clips',
              'parent_id' => NULL,
              'description' => NULL,
              'note' => NULL,
              'width' => NULL,
              'height' => NULL,
              'path' => NULL,
              'source' => NULL,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => NULL,
          ),
          6 =>
          array (
              'id' => 7,
              'table' => 'posts',
              'slug' => 'trailers',
              'title' => 'Topic or Tutorial Series Trailers (Promoted Ads)',
              'parent_id' => NULL,
              'description' => NULL,
              'note' => NULL,
              'width' => NULL,
              'height' => NULL,
              'path' => NULL,
              'source' => NULL,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => NULL,
          ),

      ));

    }
}
