<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordSearchLocaleTable extends Migration
{
    public function up()
    {
        Schema::create('keyword_search_locale', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('keyword'))->index();
            $table->foreignIdFor(app('search_locale'))->index();
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
