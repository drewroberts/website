<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('state'))->index();
            $table->string('slug')->index();
            $table->string('title');

            $table->boolean('incorporated')->default(true);
            $table->boolean('military')->default(false);
            $table->boolean('township')->default(false);
            $table->foreignIdFor(app('timezone'))->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->tinyInteger('importance')->nullable(); // Ranking of 1-5 to sort cities by importance
            $table->integer('population')->nullable(); // 2019 census data for urban population
            $table->integer('population_proper')->nullable(); // 2019 census data for municipal population
            $table->integer('density')->nullable(); // 2019 census population per square kilometer

            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();

            $table->unique(['state_id', 'slug'], 'city_unique');
        });
    }
}
