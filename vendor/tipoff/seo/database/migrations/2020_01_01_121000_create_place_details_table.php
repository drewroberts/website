<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('place_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('place'));
            $table->string('name');
            $table->foreignIdFor(app('domestic_address'))->nullable();
            $table->foreignIdFor(app('phone'))->nullable();
            $table->foreignIdFor(app('webpage'))->nullable();
            $table->date('opened_at')->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->float('longitude', 10, 6)->nullable();

            $table->foreignIdFor(app('user'), 'creator_id')->nullable(); // User that requested the place data to be updated
            $table->timestamp('created_at');
        });
    }
}
