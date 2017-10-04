<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('question_id')->index();
            $table->tinyInteger('order', 2)->unsigned()->default(1); // Use this to order the questions on the quiz. 1-99
            $table->boolean('correct')->default(0)->index(); // If is a correct answer to the question, then put 1
            $table->tinyInteger('points', 2)->default(1); // Use this to assign a value to the answer. Positive or negative. (Negative if wrong, various positive points if multiple answers)
            $table->string('text');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('answers', function($table) {
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::table('answers', function ($table) {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('answers');
        Schema::enableForeignKeyConstraints();
    }
}
