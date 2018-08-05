<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) { // Social Media Outlets/Accounts that I can push blasts/updates/broadcasts to their audiences
            $table->increments('id');
            $table->unsignedInteger('type_id')->index(); // Allows groupings for facebook, twitter, and other types of accounts. Also allows other categories (FB user account)
            $table->unsignedInteger('user_id')->index(); // Essentially the created_by but depending on the type, this could be for the user's account.
            $table->string('title');
            $table->string('username'); // URL on social outlet
            $table->string('id_number')->nullable(); // Number used by facebook or twitter for the page
            $table->string('token')->nullable(); // Facebook API token for page
            $table->unsignedInteger('avatar_id')->nullable();
            $table->unsignedInteger('cover_id')->nullable();
            $table->timestamps();
        });

        Schema::table('outlets', function($table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('avatar_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('cover_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outlets', function ($table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['avatar_id']);
            $table->dropForeign(['cover_id']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('outlets');
        Schema::enableForeignKeyConstraints();
    }
}
