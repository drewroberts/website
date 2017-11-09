<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) { // Social Media Accounts that I can push updates/broadcasts to their audiences
            $table->increments('id');
            $table->unsignedInteger('type_id')->index(); // Allows groupings for facebook, twitter, and other types of accounts. Also allows other categories (FB user account)
            $table->unsignedInteger('user_id')->index(); // Essentially the created_by but depending on the type, this could be for the user's account.
            $table->string('title');
            $table->string('username'); // URL on social outlet
            $table->string('id_number')->nullable(); // Number used by facebook or twitter for the page
            $table->string('token')->nullable(); // Facebook API token for page
            $table->unsignedInteger('avatar')->nullable();
            $table->unsignedInteger('cover')->nullable();
            $table->timestamps();
        });

        Schema::table('accounts', function($table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('avatar')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('cover')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function ($table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['avatar']);
            $table->dropForeign(['cover']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('accounts');
        Schema::enableForeignKeyConstraints();
    }
}