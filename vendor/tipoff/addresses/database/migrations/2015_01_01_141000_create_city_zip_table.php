<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityZipTable extends Migration
{
    public function up()
    {
        Schema::create('city_zip', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('city'));
            $table->foreignIdFor(app('zip'));
            $table->boolean('primary')->default(false);
            $table->timestamps();
        });
    }
}
