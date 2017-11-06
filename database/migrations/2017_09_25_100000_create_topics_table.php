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
            $table->unsignedInteger('type_id')->index(); // Allows groupings for positions in on homepage, features, treatment of topic, etc.
            // Need a parent topic relationship
            $table->string('title')->unique();
            $table->string('description');
            $table->string('excerpt'); // Longer description for homepage and parent topic pages.
            $table->unsignedInteger('image_id')->nullable()->index(); // Featured image for social sharing.
            $table->unsignedInteger('icon_id')->nullable(); // Topics have icons for menu navigation. SHould we have small icon and heroicon?
            $table->unsignedInteger('created_by')->index();
            $table->unsignedInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('topics', function($table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('icon_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
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
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('topics');
        Schema::enableForeignKeyConstraints();
    }
}
