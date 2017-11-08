<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) { // Used to notate times I have visited places. Will be different than Events. Need easy way to checkin.
            $table->increments('id');
            $table->unsignedInteger('place_id')->index();
            $table->date('visited')->index(); // What day I visited. Events where I invite people or have speaking engagements will have datetime fields.
            $table->unsignedInteger('created_by')->default(1);
            $table->timestamps();
        });

        Schema::table('visits', function($table) {
            $table->foreign('place_id')->references('id')->on('places')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::table('visits', function($table) {
            $table->unique(['place_id', 'visited'], 'unique_visit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visits', function ($table) {
            $table->dropForeign(['place_id']);
            $table->dropForeign(['created_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('visits');
        Schema::enableForeignKeyConstraints();
    }
}
