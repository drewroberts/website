<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) { // Can also use foreign countries here. Countries begin at id of 100.
            $table->increments('id');
            $table->string('slug')->unique()->index();
            $table->string('title')->unique();
            $table->string('abbreviation')->unique(); // 2 digits
            $table->string('description')->nullable(); // Description for search & social share purposes.
            $table->unsignedInteger('image_id')->nullable()->index(); // Featured image for social sharing.
            $table->unsignedInteger('icon_id')->nullable(); // If will use state outline for menu navigation. Should we have small icon and heroicon?
            $table->string('capital')->nullable();
            $table->integer('population_2010')->nullable();
            $table->integer('population_2016')->nullable();
            $table->timestamps();
        });

        Schema::table('states', function($table) {
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('icon_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('states', function ($table) {
            $table->dropForeign(['image_id']);
            $table->dropForeign(['icon_id']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('states');
        Schema::enableForeignKeyConstraints();
    }
}
