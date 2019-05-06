<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) { // Regions/cities for places I visit. URL = ./florida/cities/orlando or ./kentucky/cities/shelbyville
            $table->increments('id');
            $table->unsignedInteger('state_id')->index(); // Primary state for market. All places will use state slug.
            $table->string('slug')->unique()->index();
            $table->string('title')->unique(); // Market Title for Display. Don't need a Type_id cause will just sort markets by state & # of places.
            $table->string('description')->nullable(); // Description for search & social share purposes.
            $table->unsignedInteger('image_id')->nullable()->index(); // Featured image for social sharing.
            $table->unsignedInteger('video_id')->nullable(); // If created a featured video about the market highlighting my Top 5 places or whatever.
            $table->text('content')->nullable(); // Will be shown under video articles too
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
        });

        Schema::table('markets', function ($table) {
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }
}
