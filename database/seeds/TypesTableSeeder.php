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

        \DB::table('types')->insert(array(
          0 =>
          array(
              'id' => 1,
              'table' => 'posts',
              'slug' => 'about',
              'title' => 'About Me',
              'parent_id' => null,
              'description' => null,
              'note' => null,
              'width' => null,
              'height' => null,
              'path' => null,
              'source' => null,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => null,
          ),
          1 =>
          array(
              'id' => 2,
              'table' => 'posts',
              'slug' => 'interviews',
              'title' => 'Interviews',
              'parent_id' => null,
              'description' => null,
              'note' => null,
              'width' => null,
              'height' => null,
              'path' => null,
              'source' => null,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => null,
          ),
          2 =>
          array(
              'id' => 3,
              'table' => 'posts',
              'slug' => 'projects',
              'title' => 'Projects',
              'parent_id' => null,
              'description' => null,
              'note' => null,
              'width' => null,
              'height' => null,
              'path' => null,
              'source' => null,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => null,
          ),
          3 =>
          array(
              'id' => 4,
              'table' => 'posts',
              'slug' => 'tutorials',
              'title' => 'Tutorials',
              'parent_id' => null,
              'description' => null,
              'note' => null,
              'width' => null,
              'height' => null,
              'path' => null,
              'source' => null,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => null,
          ),
          4 =>
          array(
              'id' => 5,
              'table' => 'posts',
              'slug' => 'articles',
              'title' => 'Articles',
              'parent_id' => null,
              'description' => null,
              'note' => null,
              'width' => null,
              'height' => null,
              'path' => null,
              'source' => null,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => null,
          ),
          5 =>
          array(
              'id' => 6,
              'table' => 'posts',
              'slug' => 'definitions',
              'title' => 'Definitions',
              'parent_id' => null,
              'description' => 'Basic or SEO targeted information like: What is AMP? Why learn AMP?',
              'note' => null,
              'width' => null,
              'height' => null,
              'path' => null,
              'source' => null,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => null,
          ),
          6 =>
          array(
              'id' => 7,
              'table' => 'posts',
              'slug' => 'tips',
              'title' => 'Quick Tips / Short Clips',
              'parent_id' => null,
              'description' => null,
              'note' => null,
              'width' => null,
              'height' => null,
              'path' => null,
              'source' => null,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => null,
          ),
          7 =>
          array(
              'id' => 8,
              'table' => 'posts',
              'slug' => 'trailers',
              'title' => 'Topic or Tutorial Series Trailers (Promoted Ads)',
              'parent_id' => null,
              'description' => null,
              'note' => null,
              'width' => null,
              'height' => null,
              'path' => null,
              'source' => null,
              'created_at' => '2017-11-10 21:48:05',
              'updated_at' => '2017-11-10 21:48:05',
              'deleted_at' => null,
          ),

      ));
    }
}
