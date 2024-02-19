<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchLocalesTable extends Migration
{
    public function up()
    {
        Schema::create('search_locales', function (Blueprint $table) {
            $table->id();
            $table->string('serp_id')->index();
            $table->unsignedInteger('google_id'); // @todo rename so _id fields reserved for our database relationships
            $table->unsignedInteger('google_parent_id')->nullable(); // @todo rename so _id fields reserved for our database relationships
            $table->string('name')->unique();
            $table->string('canonical_name');
            $table->string('country_code');
            $table->string('target_type');
            $table->unsignedInteger('reach');
            $table->float('latitude', 10, 6)->nullable();
            $table->float('longitude', 10, 6)->nullable();

            $table->foreignIdFor(app('user'), 'creator_id')->nullable(); // Probably not ever used here, but just in case it is a requested run
            $table->foreignIdFor(app('user'), 'updater_id')->nullable(); // There may later be a few fields that are updatable, but most will be locked to not be editable
            $table->timestamps();
        });
    }
}
