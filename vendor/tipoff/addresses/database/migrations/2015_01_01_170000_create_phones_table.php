<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('country_callingcode')); // List of country calling codes - https://en.wikipedia.org/wiki/List_of_country_calling_codes
            $table->string('full_number', 15);

            // Nullable fields required for US numbers - https://en.wikipedia.org/wiki/North_American_Numbering_Plan
            $table->foreignIdFor(app('phone_area'))->nullable(); // Does not use ID, field is 'phone_area_code'
            $table->string('exchange_code', 3)->nullable();
            $table->string('line_number', 4)->nullable();

            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();
        });
    }
}
