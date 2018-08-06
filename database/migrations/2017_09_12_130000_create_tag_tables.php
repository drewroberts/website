<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique()->index();
            $table->string('title')->unique();
            $table->timestamps();
        });


        Schema::create('taggables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tag_id')->index();
            $table->string('taggable_type')->index(); // Posts, Resources, Brands, Places, Products
            $table->unsignedInteger('taggable_id')->index();
            $table->timestamps();
        });

        Schema::table('taggables', function ($table) {
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('taggables', function($table) {
            $table->unique(['tag_id', 'taggable_type', 'taggable_id'], 'unique_tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tags');
        Schema::enableForeignKeyConstraints();

        Schema::table('taggables', function ($table) {
            $table->dropForeign(['tag_id']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('taggables');
        Schema::enableForeignKeyConstraints();
    }
}
