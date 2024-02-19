<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('business_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index()->unique();
            $table->string('name')->index()->unique();
            $table->foreignIdFor(app('user'), 'creator_id')->nullable();
            $table->timestamp('created_at');
        });
    }
}
