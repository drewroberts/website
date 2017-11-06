<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

        Schema::table('recommendables', function($table) {
            $table->unique(['recommendation_id', 'recommendable_type', 'recommendable_id'], 'unique_item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recommendables', function ($table) {
            $table->dropForeign(['recommendation_id']);
        });
        
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('recommendables');
        Schema::enableForeignKeyConstraints();
    }
}
