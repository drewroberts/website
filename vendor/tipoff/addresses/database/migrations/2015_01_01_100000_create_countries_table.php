<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tipoff\Addresses\Models\CountryCallingcode;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 3)->unique()->index(); // lowercase ISO 3166-1 which is cca3 from https://github.com/mledoze/countries
            $table->string('title')->unique(); // common name from https://github.com/mledoze/countries
            $table->string('official')->unique(); // official name from https://github.com/mledoze/countries
            $table->string('abbreviation', 3)->unique(); // ISO 3166-1 which is the cca3 from https://github.com/mledoze/countries More about it here: https://en.wikipedia.org/wiki/ISO_3166-1 & https://en.wikipedia.org/wiki/Comparison_of_alphabetic_country_codes
            $table->string('cca2', 2)->nullable(); // cca2 from https://github.com/mledoze/countries
            $table->string('cioc', 3)->nullable(); // nullable cioc abbreviation since some contries are not part of Olympics
            $table->string('capital')->nullable();
            $table->string('world_region')->nullable();
            $table->string('world_subregion')->nullable();
            $table->integer('area')->nullable(); // Land area in km²
            $table->boolean('independent')->default(true);
            $table->boolean('un_member')->default(true);
            $table->boolean('landlocked')->default(false);
            $table->string('flag')->nullable(); // Emoji flag

            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();
        });
    }
}
