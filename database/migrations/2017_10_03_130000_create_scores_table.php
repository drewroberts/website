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
            $table->unsignedInteger('partisipant_id')->index();
            $table->tinyInteger('points_total', 2)->default(0); // Can be negative.
            $table->tinyInteger('points_correct', 2)->default(0); // Cumulative points for all correct answers that participant also marked
            $table->tinyInteger('points_wrong', 2)->default(0); // Cumulative points for all wrong answers that participant marked
            $table->tinyInteger('bonus_first', 2)->unsigned()->default(0); // If participant was the first to answer and got a bonus point
            $table->tinyInteger('bonus_ten', 2)->unsigned()->default(0); // If participant receive the bonus_ten for question

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
