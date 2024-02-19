<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyUserTable extends Migration
{
    public function up()
    {
        Schema::create('company_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('company'))->index();
            $table->foreignIdFor(app('user'))->index();
            $table->boolean('primary_contact');
            
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
            
            $table->unique(['company_id','user_id']);
        });
    }
}
