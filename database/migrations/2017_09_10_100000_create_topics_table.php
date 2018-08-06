<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) { // Website sections, topics for content.
            $table->increments('id');
            $table->string('slug')->unique()->index();
            $table->unsignedInteger('type_id')->nullable()->index(); // Allows groupings for positions in on homepage, features, treatment of topic, etc.
            $table->string('title')->unique();
            $table->string('description')->nullable();
            $table->mediumText('excerpt')->nullable(); // Longer introduction for homepage and parent topic pages.
            $table->string('note')->nullable(); // Just for internal reference purposes only, not displayed on website. What type of articles should be posted vs other topics?
            $table->unsignedInteger('image_id')->nullable(); // Featured image for the topic. Typically just heroicon on a stylized color background.
            $table->unsignedInteger('icon_id')->nullable(); // Topics have icons for menu navigation.
            $table->unsignedInteger('heroicon_id')->nullable(); // Topics have heroicons that display when featured.
            $table->unsignedInteger('poster_id')->nullable(); // Topics have posters that are link book cover / movie cover style images for homepage.
            $table->unsignedInteger('ogimage_id')->nullable(); // External open graph image id. Featured image for social sharing. Will default to image_id unless this is used. Allows override for play button or words on image.
            $table->text('content')->nullable(); // If want to show content on article index page, put it here. Not necessary but helps SEO and user understanding.
            $table->integer('pageviews')->default(0)->unsigned()->index(); // Total pageviews for topic index. Updated periodically.
            $table->integer('pageviews_articles')->default(0)->unsigned()->index(); // Total pageviews for articles in the topic. Updated periodically.
            $table->unsignedInteger('created_by')->default(1)->index();
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('topics', function($table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('icon_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('heroicon_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('poster_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('ogimage_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::table('topics', function ($table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['image_id']);
            $table->dropForeign(['icon_id']);
            $table->dropForeign(['heroicon_id']);
            $table->dropForeign(['poster_id']);
            $table->dropForeign(['ogimage_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('topics');
        Schema::enableForeignKeyConstraints();
    }
}
