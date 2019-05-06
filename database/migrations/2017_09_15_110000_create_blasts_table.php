<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blasts', function (Blueprint $table) { // Automated Social Media Blasts (Formerly known as Broadcasts) to our controlled social platforms (accounts)
            $table->increments('id');
            $table->unsignedInteger('platform_id')->index();
            $table->unsignedInteger('type_id')->index(); // Allows groupings for facebook, twitter, and other types of social platforms. Also allows other categories of pushes.
            $table->string('blastable_type')->index(); // Type of content being broadcasted. Can be a post, image, video, recommendations, etc.
            $table->unsignedInteger('blastable_id')->index();
            $table->string('url')->nullable(); // URL of the post on facebook or tweet. Nullable because won't have it at first.
            $table->string('id_number')->nullable(); // ID number for post or tweet.
            $table->string('message');
            $table->string('link')->nullable(); // Need this because can share link to the amp page on Google or something else
            $table->string('type')->nullable(); // On facebook this could be photo or video, or something else
            $table->string('impressions')->nullable();
            $table->string('consumptions')->nullable(); // Typically this is link clicks
            $table->string('likes')->nullable(); // Favorites on twitter
            $table->string('comments')->nullable(); // Replies on twitter
            $table->string('shares')->nullable(); // Retweets
            $table->string('is_hidden')->nullable();
            $table->string('timeline_visibility')->nullable();
            $table->timestamp('published_at')->nullable(); // Used when can get time for when articles published on social media account. Will be important for user posts.
            $table->string('creator_name')->nullable(); // Creator Name. Will be our app for most facebook posts, but some will be done manually on facebook.
            $table->unsignedInteger('created_by')->nullable(); // If can match it the creator name to a user id. Otherwise, use id of 1.
            $table->timestamps();
        });

        Schema::table('blasts', function ($table) {
            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }
}
