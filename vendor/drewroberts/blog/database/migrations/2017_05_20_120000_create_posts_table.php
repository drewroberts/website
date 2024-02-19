<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->index();
            $table->string('title')->unique();
            $table->foreignIdFor(app('topic'))->nullable(); // Group blog posts into topics
            $table->foreignIdFor(app('series'))->nullable(); // Group blog posts into series
            $table->foreignIdFor(app('layout'))->nullable(); // Will remove nullable and default a basic layout for posts. Allows some posts to have different layout (AMP or regular html & other variations)
            $table->text('content')->nullable(); // Will be written in Markdown.

            $table->foreignIdFor(app('webpage'))->nullable(); // Used to track seo rankings
            $table->unsignedInteger('pageviews')->index(); // Total current pageviews for post. Will be synced from Google Analytics API.

            $table->string('description')->nullable(); // Primary description used for SEO.
            $table->string('ogdescription')->nullable(); // Open Graph Description used for social shares. Will default to description if NULL.
            $table->foreignIdFor(app('image'))->nullable(); // Cover image for blog post
            $table->foreignIdFor(app('image'), 'ogimage_id')->nullable(); // External open graph image id. Featured image for social sharing. Will default to image_id unless this is used. Allows override for play button or words on image.
            $table->foreignIdFor(app('video'))->nullable(); // If blog post has a featured video.

            $table->foreignIdFor(app('user'), 'author_id'); // Author of the post.
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');

            $table->dateTime('published_at'); // Allows blog posts to be published at a later date.
            $table->softDeletes();
            $table->timestamps();
        });
    }
}
