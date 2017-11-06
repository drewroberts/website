<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique()->index();
            $table->string('title')->unique();
            $table->string('abbreviation')->unique(); // 2 digits
            $table->string('description')->nullable(); // Description for search & social share purposes.
            $table->unsignedInteger('image_id')->nullable()->index(); // Featured image for social sharing.
            $table->unsignedInteger('icon_id')->nullable(); // If will use state outline for menu navigation. Should we have small icon and heroicon?
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
        Schema::dropIfExists('states');
    }
}
