<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) { // Used for everything that needs to be categorized. Images, Videos, Resources, Sessions, Topics, etc.
            $table->increments('id');
            $table->string('slug')->unique()->index();
            $table->string('title')->unique();
            $table->string('description');
            $table->string('width')->nullable(); // Image & Video Types Only
            $table->string('height')->nullable(); // Image & Video Types Only
            $table->string('path')->nullable(); // Image & Video Types Only
            $table->string('source')->nullable(); // Image, Video & Account Types Only. YouTube, Vimeo, Facebook, Instagram, Twitter, local video, etc.
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
