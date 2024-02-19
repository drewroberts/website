<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessCategorizablesTable extends Migration
{
    public function up()
    {
        Schema::create('business_categorizables', function (Blueprint $table) {
            $table->foreignIdFor(app('business_category'));
            $table->morphs('categorizable', 'categorizable_key');
            $table->unique(['business_category_id', 'categorizable_id', 'categorizable_type'], 'categorizable_unique');
        });
    }
}
