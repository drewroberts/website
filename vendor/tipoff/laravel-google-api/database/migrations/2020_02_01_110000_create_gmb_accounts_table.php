<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGmbAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('gmb_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');
            $table->foreignIdFor(app('key'));
 
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
