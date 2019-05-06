<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) { // Brands, products, places can all have multiple reviews. Polymorphic relationship of one review to one of those reviewable models. Reviews don't have their own URL, just show as content in a section on the pages of other models.
            $table->increments('id');
            $table->string('reviewable_type')->index(); // Brands, products, places
            $table->unsignedInteger('reviewable_id')->index();
            $table->unsignedInteger('video_id')->nullable(); // If review has a video. Can have multiple images through polymorphic images model.
            $table->unsignedInteger('type_id')->nullable(); // Use for primary grouping of reviews by types. Can use other categories as well
            $table->date('visited')->nullable(); // If review is based on a specific visit to place or use of product, then put date here.
            $table->text('content'); // Will be shown under video reviews too. If review is external (Google Maps, Facebook, etc.), then paste the review text here.
            $table->string('maps')->nullable()->unique(); // URL or preferably the ID of review on Google Maps
            $table->string('facebook')->nullable()->unique(); // URL of review on facebook page
            $table->string('site')->nullable()->unique(); // URL of review on another external site.
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('reviews', function ($table) {
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }
}
