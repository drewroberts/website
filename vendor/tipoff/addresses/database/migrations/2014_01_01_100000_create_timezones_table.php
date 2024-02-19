
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimezonesTable extends Migration
{
    public function up()
    {
        Schema::create('timezones', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Abbreviation
            $table->string('title')->unique();
            $table->string('php')->unique(); // Supported PHP Timezone: https://www.php.net/manual/en/timezones.php
            $table->boolean('is_daylight_saving')->default(1); // Just for reference, Carbon has this.
            $table->decimal('dst', 4, 2)->nullable(); // Just for reference, Carbon has this.
            $table->decimal('standard', 4, 2)->nullable(); // Just for reference, Carbon has this.
        });
    }
}
