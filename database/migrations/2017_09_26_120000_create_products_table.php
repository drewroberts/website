<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) { // Various products or services that I recommend
            $table->increments('id');
            $table->unsignedInteger('brand_id')->nullable()->index(); // If brand created, then assign here
            $table->string('slug')->unique()->index(); // How location will display on the front end of website. No underscores, only lowercase letters and dashes.
            $table->string('title')->unique(); // Name of product for display
            $table->string('description'); // Really is an excerpt for social.
            $table->unsignedInteger('image_id')->nullable(); // path to edited cover image for the recommendation
            $table->unsignedInteger('video_id')->nullable(); // If video, then include the video id here.
            $table->unsignedInteger('type_id')->nullable(); // Use for primary grouping of products by types. Can use other categories as well
            $table->date('launched')->nullable(); // Estimated date when product first available.
            $table->date('expired')->nullable();
            $table->text('content'); // Will be shown under video articles too
            $table->string('facebook')->nullable()->unique(); // Username if product has own facebook page
            $table->string('instagram')->nullable()->unique(); // Username if product has own instagram account
            $table->string('twitter')->nullable()->unique(); // Username if product has own twitter account
            $table->string('youtube')->nullable()->unique(); // Username if product has own YouTube channel
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('products', function($table) {
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::table('products', function ($table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['image_id']);
            $table->dropForeign(['video_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('products');
        Schema::enableForeignKeyConstraints();
    }
}
