<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) { // Mainly used for quiz sessions for people to participate, but can also be used for conferences, sporting events, and other events. Push a link to my homepage when sesssion is going on.
            $table->increments('id');
            $table->unsignedInteger('quiz_id')->index(); // Allows the setting of the current state of the quiz. For example the question # or when it it linked from homepage or has ended. Need to flesh out this concept more.
            $table->unsignedInteger('question_id')->nullable()->index(); // Keeps up with the current question for live quiz sessions. Controlled by admin
            $table->unsignedInteger('stage_id')->index(); // Allows the setting of the current stage of the quiz. For example the question # or when it it linked from homepage or has ended. Need to flesh out this concept more.
            $table->tinyInteger('bonus_first', 2)->unsigned()->default(1); // Bonus points for being first to answer question.
            $table->tinyInteger('bonus_ten', 2)->unsigned()->default(1); // Bonus points for being within 10 seconds of first response. First responder also gets the point.
            
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
        Schema::dropIfExists('sessions');
    }
}
