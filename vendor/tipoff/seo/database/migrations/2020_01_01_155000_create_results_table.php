<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('ranking'))->index();
            $table->string('type')->index(); // Example: 'Organic', 'Local', 'Ads', 'Inline Video'
            $table->unsignedTinyInteger('position')->index();
            $table->foreignIdFor(app('result'), 'parent_id')->nullable(); // Parent Result

            // resultable_id, resultable_type either Tipoff\Seo\Models\Webpage or Place
            $table->morphs('resultable');

            // Don't need timestamps since can use created_at timestamp of the ranking class

            //$table->unique(['ranking_id', 'type', 'position'], 'result_unique');
        });
    }
}
