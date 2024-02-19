<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryCallingcodesTable extends Migration
{
    public function up()
    {
        Schema::create('country_callingcodes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('country')); // Some countries have more than one Calling Code
            $table->string('code', 6); // Without the plus sign. https://en.wikipedia.org/wiki/List_of_country_calling_codes
            $table->string('display')->nullable(); // Formatted for displaying with a phone number. Ex: "+1 242"
            $table->string('root', 2); // +1 through +9 including the plus sign for the 9 zones. Need to create Enums for this field.
            $table->string('suffix', 5)->nullable();
            
            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();
            
            $table->unique(['country_id', 'code'], 'callingcode_unique');
        });
    }
}

