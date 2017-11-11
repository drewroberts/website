<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) { // Use URL path of drewroberts.com/recommends/something. One to many relationship with brands, products, places, and reviews. Brands can also be topics, so brand recommendation pages can link to topic page and display articles too.
            $table->increments('id');
            $table->string('slug')->unique()->index();
            $table->string('title');
            $table->string('description'); // Really is an excerpt for social.
            $table->unsignedInteger('image_id')->nullable(); // path to edited cover image for the recommendation
            $table->unsignedInteger('video_id')->nullable(); // If video, then include the video id here.
            $table->unsignedInteger('brand_id')->nullable()->unique()->index(); // If the recommendation is just one brand, then put brand_id here and this becomes the URL for the brand. 1 to 1 relationship.
            $table->unsignedInteger('type_id')->index();
            $table->boolean('feature')->default(0)->index(); // If recommendation is big traffic driver and should be featured, then put 1
            $table->text('content'); // Will be shown under video articles too
            $table->string('pageviews')->nullable(); // Total current pageviews for recommendation. Pageview time breakdowns will be in stats table.
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('recommendations', function($table) {
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('topics')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::table('recommendations', function ($table) {
            $table->dropForeign(['image_id']);
            $table->dropForeign(['video_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('recommendations');
        Schema::enableForeignKeyConstraints();
    }
}
