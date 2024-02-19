<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('domestic_address'))->index();
            $table->morphs('addressable');
            $table->string('type');     // Shipping, Billing enums
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('care_of')->nullable();
            $table->string('company')->nullable();
            $table->string('extended_zip')->nullable();
            $table->foreignIdFor(app('phone'))->nullable();
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();

            $table->unique(['domestic_address_id', 'addressable_id', 'addressable_type', 'type'], 'address_unique_key');
        });
    }
}
