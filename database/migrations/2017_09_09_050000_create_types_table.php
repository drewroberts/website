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
        Schema::create('types', function (Blueprint $table) { // Used for everything that needs to be categorized. Images, Videos, Resources, Sessions, Topics, Posts, etc. ON Topic pages, it determines the sections (Tutorials, Articles, Trailers, Clips, Projects, etc.)
            $table->increments('id');
            $table->string('table')->index(); // Each type can only be used on one other database table. Example = 'images', 'videos', 'posts', etc. These are strings, so must be recorded exactly the same. We'll use the lowercase plural table name.
            $table->string('slug')->unique()->index();
            $table->string('title')->unique();
            $table->unsignedInteger('parent_id')->nullable()->index(); // Allows parent types like tutorials to have children for different series.
            $table->string('description')->nullable();
            $table->string('note')->nullable(); // Just for internal reference purposes only, not displayed on website.
            $table->string('width')->nullable(); // Image & Video Types Only
            $table->string('height')->nullable(); // Image & Video Types Only
            $table->string('path')->nullable(); // Image & Video Types Only
            $table->string('source')->nullable(); // Image, Video & Account Types Only. YouTube, Vimeo, Facebook, Instagram, Twitter, local video, etc.
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('types', function ($table) {
            $table->foreign('parent_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
        });
    }
}
