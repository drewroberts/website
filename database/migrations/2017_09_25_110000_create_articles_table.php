<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id')->index();
            $table->string('slug')->unique()->index();
            $table->string('title');
            $table->string('description'); // Really is an excerpt for social.
            $table->unsignedInteger('image_id')->index(); // path to edited cover image for article
            $table->unsignedInteger('video_id')->nullable(); // If video, then include the video id here.
            $table->boolean('feature')->default(0)->index(); // If article is big news and should be featured, then put 1
            $table->text('content'); // Will be shown under video articles too
            $table->string('pageviews')->nullable(); // Total current pageviews for article. Pageview time breakdowns will be in stats table.
            $table->unsignedInteger('editor_id')->nullable(); // Will use later when have editorial system. All contributing authors will be in contributors table.
            $table->unsignedInteger('created_by'); // Default author_id should be me! But can use this in case some need a different author down the road.
            $table->unsignedInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('articles', function($table) {
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('editor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::table('articles', function ($table) {
            $table->dropForeign(['topic_id']);
            $table->dropForeign(['editor_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('articles');
        Schema::enableForeignKeyConstraints();
    }
}
