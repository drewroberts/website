<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique()->index(); // How location will display on the front end of website. No underscores, only lowercase letters and dashes.
            $table->string('title')->unique(); // Name of place for display
            $table->string('description'); // Really is an excerpt for social.
            $table->unsignedInteger('image_id')->index(); // path to edited cover image for the recommendation
            $table->unsignedInteger('video_id')->nullable(); // If video, then include the video id here.
            $table->unsignedInteger('topic_id')->nullable(); // If brand is also a topic for articles/videos, then include the topic id here.
            $table->unsignedInteger('type_id')->nullable(); // Use for primary grouping of brands by types. Can use other categories as well
            $table->date('launched')->nullable(); // Estimated date when company started
            $table->text('content'); // Will be shown under video articles too
            $table->string('website')->nullable()->unique(); // URL of brand's website
            $table->string('facebook')->nullable()->unique(); // Username of brand's facebook page
            $table->string('instagram')->nullable()->unique(); // Username of brand's instagram account
            $table->string('twitter')->nullable()->unique(); // Username of brand's twitter account
            $table->string('youtube')->nullable()->unique(); // Username of brand's YouTube channel
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('brands', function($table) {
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function ($table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['image_id']);
            $table->dropForeign(['video_id']);
            $table->dropForeign(['topic_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('brands');
        Schema::enableForeignKeyConstraints();
    }
}
