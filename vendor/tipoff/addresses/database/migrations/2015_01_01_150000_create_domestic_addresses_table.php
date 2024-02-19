<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomesticAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('domestic_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->foreignIdFor(app('city'));
            $table->foreignIdFor(app('zip'));
            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();

            $table->unique(['address_line_1', 'address_line_2', 'city_id', 'zip_code'], 'address_unique');
        });
    }
}
