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
            $table->string('name'); // Will override with profile display_name if profile completed
            $table->string('email')->unique();
            $table->string('username')->unique(); // Default generated for user on newsletter registration
            $table->string('password', 60); // Random generated for user on newsletter registration
            $table->boolean('subscriber')->default(true)->index(); // Mark false if unsubscribe from weekly newsletter
            $table->boolean('verified')->default(false); // Change to true when email verified
            $table->string('id_token')->nullable(); // Unique random token for the user. Generated when register, deleted when verify email.
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
}
