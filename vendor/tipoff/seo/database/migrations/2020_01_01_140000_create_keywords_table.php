<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordsTable extends Migration
{
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->id();
            $table->string('phrase')->index()->unique();
            $table->string('type')->index(); // Example: 'Branded', 'Generic', 'Local'
            $table->dateTime('tracking_requested_at')->nullable();
            $table->dateTime('tracking_stopped_at')->nullable();

            $table->foreignIdFor(app('keyword'), 'parent_id')->nullable();
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
