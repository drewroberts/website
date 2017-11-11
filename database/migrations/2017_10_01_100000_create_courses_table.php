<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id')->index();
            $table->unsignedInteger('type_id')->index();
            $table->string('slug')->unique()->index();
            $table->string('title');
            $table->string('description'); // Really is an excerpt for social.
            $table->string('excerpt'); // Longer description for promo
            $table->text('intro'); // Even longer
            $table->unsignedInteger('image_id')->nullable(); // path to edited cover image for article
            $table->unsignedInteger('video_id')->nullable(); // Primary pomotional video for course. Can have more with videoable entries and types.
            $table->boolean('feature')->default(0)->index(); // If article is big news and should be featured, then put 1
            
            // Need a model for course classes. Can't name it that, naming Episodes.
            $table->unsignedInteger('taught_by')->default(1)->index(); // Primary teacher for course.
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
