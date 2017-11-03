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
        Schema::create('resources', function (Blueprint $table) { // External links for more info on topic. Good articles, documentation, etc. broken into types.
            $table->increments('id');
            $table->unsignedInteger('topic_id')->index();
            $table->unsignedInteger('type_id')->index();
            $table->string('slug')->unique()->index();
            $table->string('title');
            $table->string('description'); // Really is an excerpt for social.
            $table->unsignedInteger('image_id')->unsigned()->index(); // path to edited cover image for resource
            $table->tinyInteger('order')->unsigned()->default(1); // Use this to order the resources for the resource type on the topic. 1-99
            $table->string('resourceable_type')->nullable(); // Link to internal resources on the topic
            $table->unsignedInteger('resourceable_id')->nullable();
            $table->text('content'); // Will be shown under video resources too
            $table->string('url'); // For external resources

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
