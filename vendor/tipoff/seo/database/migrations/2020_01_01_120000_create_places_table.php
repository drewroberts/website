<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('place_location')->unique(); // Google Places ID. Would prefer different field name.
            $table->string('name')->nullable();
            $table->string('maps_url')->nullable(); // URL for place's Google Maps page. (@todo convert to Webpage resource)
            $table->foreignIdFor(app('webpage'))->nullable();
            $table->foreignIdFor(app('company'))->nullable(); // Automatically pulled from webpage->domain->company on model saving

            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->foreignIdFor(app('user'), 'updater_id')->nullable();
            $table->timestamps();
        });
    }
}
