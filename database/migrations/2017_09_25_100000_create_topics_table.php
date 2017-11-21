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
        Schema::create('topics', function (Blueprint $table) { // Website sections, topics for content
            $table->increments('id');
            $table->string('slug')->unique()->index();
            $table->unsignedInteger('type_id')->nullable()->index(); // Allows groupings for positions in on homepage, features, treatment of topic, etc.
            $table->unsignedInteger('parent_id')->nullable()->index(); // ID of the parent topic relationship. ID's below 20.
            $table->string('title')->unique();
            $table->string('description')->nullable();
            $table->mediumText('excerpt')->nullable(); // Longer introduction for homepage and parent topic pages.
            $table->string('note')->nullable(); // Just for internal reference purposes only, not displayed on website.
            $table->unsignedInteger('image_id')->nullable(); // Featured image for social sharing. Typically just heroicon on a stylized color background.
            $table->unsignedInteger('icon_id')->nullable(); // Topics have icons for menu navigation.
            $table->unsignedInteger('heroicon_id')->nullable(); // Topics have heroicons that display when featured.
            $table->unsignedInteger('created_by')->default(1)->index();
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('topics', function($table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('parent_id')->references('id')->on('topics')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('icon_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('heroicon_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
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
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['image_id']);
            $table->dropForeign(['icon_id']);
            $table->dropForeign(['heroicon_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('topics');
        Schema::enableForeignKeyConstraints();
    }
}
