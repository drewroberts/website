`<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) { // User Details
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique()->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('display_name')->nullable();
            $table->unsignedInteger('avatar_id')->nullable();
            $table->unsignedInteger('cover_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('prefix', 6)->nullable(); // Could be Dr. or other prefix
            $table->string('suffix')->nullable();
            $table->string('title')->nullable();
            $table->string('tagline')->nullable();
            $table->string('phone', 25)->nullable();
            $table->unsignedInteger('billing_id')->nullable()->index(); // Primary address for account billing.
            $table->unsignedInteger('mailing_id')->nullable()->index(); // If mailing address is different, then can define here.
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('github')->nullable();
            $table->date('birth')->nullable();
            $table->timestamp('last_read_announcements_at')->nullable();
            $table->timestamps();
        });

        Schema::table('profiles', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('avatar_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('cover_id')->references('id')->on('images')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('billing_id')->references('id')->on('addresses')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('mailing_id')->references('id')->on('addresses')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function ($table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['avatar_id']);
            $table->dropForeign(['cover_id']);
            $table->dropForeign(['billing_id']);
            $table->dropForeign(['mailing_id']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('profiles');
        Schema::enableForeignKeyConstraints();
    }
}