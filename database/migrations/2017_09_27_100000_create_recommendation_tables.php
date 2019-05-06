<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) { // Use URL path of drewroberts.com/recommends/something. 4 types of recommendations - single product, single brand (can include multiple places or products for that brand), or many to many relationship with brands, products, places, and reviews (top places, or favorite products in a category). Products & Brands do not have their own URL's. Brands can also be topics, so brand recommendations can link to topic page and display articles too.
            $table->increments('id');
            $table->string('slug')->unique()->index();
            $table->string('title');
            $table->string('description'); // Really is an excerpt for social.
            $table->unsignedInteger('image_id')->nullable(); // Featured cover image for social sharing.
            $table->unsignedInteger('video_id')->nullable(); // If video, then include the video id here. Will replace cover image on layout.
            $table->unsignedInteger('brand_id')->nullable()->unique()->index(); // If is a brand recommendation, then put brand_id here and this becomes the URL for the brand. 1 to 1 relationship. If is null, then is recommendation for product or for multiple places/products.
            $table->unsignedInteger('product_id')->nullable()->unique()->index(); // If is a product recommendation, then put product_id here and this becomes the URL for the product. 1 to 1 relationship. Brand_id should be null if product_id is listed unless brand only has one product and no places. If is null, then is recommendation for the brand or for multiple things.
            $table->unsignedInteger('type_id')->index();
            $table->unsignedInteger('icon_id')->nullable(); // Some types of recommendations have icons for menu navigation.
            $table->unsignedInteger('heroicon_id')->nullable(); // Some types of recommendations have heroicons that display when featured.
            $table->boolean('feature')->default(0)->index(); // If recommendation is big traffic driver and should be featured on ./recommends, then put 1
            $table->text('content')->nullable(); // Nullable because sometimes will be completed later. Will be shown under video recommendations too
            $table->integer('pageviews')->default(0)->unsigned()->index(); // Total pageviews for recommendation. Updated periodically.
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('recommendations', function ($table) {
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('topics')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('icon_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('heroicon_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });


        Schema::create('recommendables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recommendation_id')->index();
            $table->string('recommendable_type')->index(); // Brands, products, places
            $table->unsignedInteger('recommendable_id')->index();
            $table->timestamps();
        });

        Schema::table('recommendables', function ($table) {
            $table->foreign('recommendation_id')->references('id')->on('recommendations')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('recommendables', function ($table) {
            $table->unique(['recommendation_id', 'recommendable_type', 'recommendable_id'], 'unique_item');
        });
    }
}
