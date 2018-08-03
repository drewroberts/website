<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id')->index(); // Determines URL and determines if is a Project or Interview instead of other type of post.
            $table->string('slug')->unique()->index();
            $table->string('title')->unique();
            $table->string('description'); // Really is an excerpt for social.
            $table->unsignedInteger('image_id')->nullable(); // path to edited cover image for post
            $table->unsignedInteger('ogimage_id')->nullable(); // External open graph image id. Featured image for social sharing. Will default to image_id unless this is used. Allows override for play button or words on image.
            $table->unsignedInteger('type_id')->index(); // Determines if is Article, Tutorial, Clip, Trailer, etc.
            $table->unsignedInteger('video_id')->unique()->nullable(); // If video, then include the video id here. A video can only be assigned to one post.
            $table->unsignedInteger('episode')->index(); // Episode number if needs one. Used for Tutorial Series.
            $table->boolean('feature')->default(0)->index(); // If post is big news and should be featured, then put 1
            $table->text('content'); // Will be shown under video posts too
            $table->string('pageviews')->nullable(); // Total current pageviews for post. Pageview time breakdowns will be in stats table.
            $table->unsignedInteger('editor_id')->nullable(); // Will use later when have editorial system. All contributing authors will be in contributors table.
            $table->unsignedInteger('created_by')->default(1); // Default author_id should be me! But can use this in case some need a different author down the road.
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('posts', function($table) {
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
        Schema::table('posts', function ($table) {
            $table->dropForeign(['topic_id']);
            $table->dropForeign(['image_id']);
            $table->dropForeign(['video_id']);
            $table->dropForeign(['editor_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('posts');
        Schema::enableForeignKeyConstraints();
    }
}
