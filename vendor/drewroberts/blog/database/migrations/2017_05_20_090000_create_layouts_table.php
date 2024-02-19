<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('layouts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('layout_type'); // Model that the layout applies to. Uses LayoutType Enum
            $table->string('view'); // Classname with namespace or maybe a dot array syntax to the view
            $table->string('note')->nullable(); // Just for internal reference purposes only, not displayed on website.
            $table->foreignIdFor(app('image'))->nullable(); // Preview image for the layout structure

            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();
        });
    }
}
