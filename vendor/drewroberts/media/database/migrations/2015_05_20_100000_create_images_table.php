<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->unique()->index(); // Includes path to file and the file type
            $table->string('width');
            $table->string('height');
            $table->text('description')->nullable();
            $table->string('alt')->nullable();
            $table->string('credit')->nullable(); // Used for amp-img attribution

            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
