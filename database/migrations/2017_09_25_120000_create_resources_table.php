<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) { // External links for more info on topic. Good articles, documentation, GitHub, links to YouTube videos, etc. sorted into types.
            $table->increments('id');
            $table->unsignedInteger('topic_id')->index();
            $table->unsignedInteger('type_id')->index();
            $table->string('slug')->unique()->index();
            $table->string('title');
            $table->string('description'); // Really is an excerpt for social.
            $table->text('content'); // Will show on website, use to make comment about resource
            $table->unsignedInteger('image_id')->unsigned(); // path to edited cover image for resource
            $table->string('url'); // For external resource link
            $table->string('resourceable_type')->nullable(); // Link to internal resources on the topic
            $table->unsignedInteger('resourceable_id')->nullable();
            $table->tinyInteger('order')->unsigned()->default(1); // Use this to order the resources for the resource type on the topic. 1-99
            $table->text('content_external'); // Won't show on website, but good to copy full content of the external article, etc. for search purposes.
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('resources', function($table) {
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
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
      Schema::table('resources', function ($table) {
          $table->dropForeign(['topic_id']);
          $table->dropForeign(['type_id']);
          $table->dropForeign(['image_id']);
          $table->dropForeign(['created_by']);
          $table->dropForeign(['updated_by']);
      });

      Schema::disableForeignKeyConstraints();
      Schema::dropIfExists('resources');
      Schema::enableForeignKeyConstraints();
    }
}
