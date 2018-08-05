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
        Schema::create('blasts', function (Blueprint $table) { // Automated Social Media Blasts (used to call Broadcasts) to our controlled social outlets (accounts)
            $table->increments('id');
            $table->unsignedInteger('outlet_id')->index();
            $table->unsignedInteger('type_id')->index(); // Allows groupings for facebook, twitter, and other types of social outlets. Also allows other categories of pushes.
            $table->string('broadcastable_type')->index(); // Type of content being broadcasted. Can be an image, video, article, etc.
            $table->unsignedInteger('broadcastable_id')->index();
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

        Schema::table('blasts', function($table) {
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blasts', function ($table) {
            $table->dropForeign(['outlet_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['created_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('blasts');
        Schema::enableForeignKeyConstraints();
    }
}
