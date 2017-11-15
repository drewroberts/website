<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zips', function (Blueprint $table) {
            $table->string('code', 5)->unique()->primary(); // Actual ZIP Code. Has to be string because can have leading zeros. Check model to see how it is made Primary Key.
            $table->unsignedInteger('state_id')->index(); // Primary state for ZIP Code.
            $table->unsignedInteger('market_id')->nullable()->index(); // ID of market in which ZIP Code belongs
            $table->string('city', 50); // Primary city name.
            $table->string('city_alternate')->nullable();
            $table->string('city_alternate_2')->nullable();
            $table->string('city_alternate_3')->nullable();
            $table->string('city_alternate_4')->nullable(); // Is there any ZIP Code with more than 5 acceptable city names?
            $table->string('county')->nullable();
            $table->decimal('latitude', 8, 6)->nullable();
            $table->decimal('longitude', 8, 6)->nullable();
            $table->unsignedInteger('population')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zips');
    }
}
