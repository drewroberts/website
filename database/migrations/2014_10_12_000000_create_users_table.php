<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // Will override with profile display_name if profile completed. User won't be able to edit this.
            $table->string('email')->unique();
            $table->string('username')->unique(); // Default generated for user on newsletter registration
            $table->string('password', 60); // Random generated for user on newsletter registration
            $table->string('id_token')->nullable(); // Unique random token for the user. Generated when register, deleted when verify email.
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('verified_at')->nullable(); // NUll before email verified
            $table->timestamp('unsubscribed_at')->nullable(); // By default, verified users are newsletter subscribers. Mark time if unsubscribe.
            $table->softDeletes();
        });
    }
}
