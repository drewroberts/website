<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchVolumesTable extends Migration
{
    public function up()
    {
        Schema::create('search_volumes', function (Blueprint $table) {
            $table->id();
            $table->string('engine', 64)->index(); // Example: 'google', 'bing' (haha)
            $table->string('provider', 64)->index(); // Example: 'google search console', 'serpapi', 'moz', 'ahrefs'
            $table->foreignIdFor(app('keyword'))->index();
            $table->string('range', 32)->index(); // Ex: 'month', 'week', 'day'. Will just use month for now as the ranges for search volumes
            $table->string('range_value', 32)->index(); // Example: 2021-05 for month range or a date for day range. Undecided what to use for week range. May convert to date field later.

            $table->integer('queries');
            $table->integer('clicks')->nullable(); // For search console only

            $table->foreignIdFor(app('user'), 'creator_id')->nullable(); // Probably not ever used here, but just in case it is a requested run
            $table->foreignIdFor(app('user'), 'updater_id')->nullable(); // There may later be a few fields that are updatable, but most will be locked to not be editable
            $table->timestamps();

            $table->unique(['engine', 'provider', 'keyword_id', 'range', 'range_value'], 'search_volume_unique');
        });
    }
}
