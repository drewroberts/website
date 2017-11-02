<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_id')->index(); // Use for URL structure. Example drewroberts.com/florida/orlando/corona or //florida/winter-park/barnies
            $table->string('slug')->unique()->index(); // How location will display on the front end of website. No underscores, only lowercase letters and dashes.
            $table->string('name')->unique(); // Name of place for display
            $table->date('first_visit')->default('2015-01-01'); // First time I went to place
            $table->date('opened')->default('2015-01-01'); // Estimated open date
            $table->date('closed')->nullable();
            $table->boolean('multiple')->default(0); // If is a franchise or part of company with multiple locations then put 1
            $table->unsignedInteger('type_id')->nullable(); // Use for primary grouping of places by types. Can use other categories as well
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip', 5)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('timezone')->nullable();
            $table->string('gmaps')->nullable()->unique(); // ID for location's Google Maps page
            $table->string('facebook')->nullable()->unique(); // Username for location's facebook page
            $table->string('instagram')->nullable()->unique(); // Username for location's instagram account
            $table->string('twitter')->nullable()->unique(); // Username for location's twitter account
            $table->string('youtube')->nullable()->unique(); // Username for location's YouTube channel
            $table->decimal('latitude', 8, 6)->nullable();
            $table->decimal('longitude', 8, 6)->nullable();
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('places', function($table) {
            $table->foreign('market_id')->references('id')->on('markets')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::table('places', function ($table) {
            $table->dropForeign(['market_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('places');
        Schema::enableForeignKeyConstraints();
    }
}
