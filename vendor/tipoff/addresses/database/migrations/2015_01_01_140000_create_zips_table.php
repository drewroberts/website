<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipsTable extends Migration
{
    public function up()
    {
        Schema::create('zips', function (Blueprint $table) {
            $table->string('code', 5)->unique()->primary(); // Actual ZIP Code. Has to be string because can have leading zeros. Check model to see how it is made Primary Key.
            $table->foreignIdFor(app('state'));
            $table->foreignIdFor(app('region'))->nullable();
            $table->foreignIdFor(app('timezone'))->nullable();

            $table->integer('population')->nullable(); // 2019 census data for zip population
            $table->integer('density')->nullable(); // 2019 census population per square kilometer
            $table->float('latitude', 10, 6)->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->boolean('military')->default(false);
            $table->boolean('ztca')->default(true);
            $table->string('parent_zip_code')->nullable();

            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();
        });

        Schema::table('zips', function (Blueprint $table) {
            $table->foreign('parent_zip_code')->references('code')->on('zips')->nullable(); // Parent zcta zip code
        });
    }
}
