<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) { // Computed for participants based on question in a quiz session
            $table->increments('id');
            $table->unsignedInteger('session_id')->index();
            $table->unsignedInteger('question_id')->index();
            $table->unsignedInteger('partisicpant_id')->index();
            $table->tinyInteger('points_total', 2)->default(0); // Can be negative.
            $table->tinyInteger('bonus_first', 2)->unsigned()->default(0); // 
            $table->tinyInteger('bonus_ten', 2)->unsigned()->default(0); // Can be negative.

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
        Schema::dropIfExists('scores');
    }
}
