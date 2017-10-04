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
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('display_name')->nullable();
            $table->unsignedInteger('avatar')->nullable();
            $table->unsignedInteger('cover')->nullable();
            $table->string('gender')->nullable();
            $table->string('prefix', 6)->nullable(); // Could be Dr. or other prefix
            $table->string('suffix')->nullable();
            $table->string('title')->nullable();
            $table->string('tagline')->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('github')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('mailing_address_line_2')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('mailing_state')->nullable();
            $table->string('mailing_zip', 25)->nullable();
            $table->string('mailing_country', 2)->nullable();
            $table->date('birth')->nullable();
            $table->string('ce;;', 25)->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->tinyInteger('uses_two_factor_auth')->default(0);
            $table->string('authy_id')->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('two_factor_reset_code', 100)->nullable();
            $table->integer('current_team_id')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('current_billing_plan')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->string('card_country')->nullable();
            $table->string('vat_id', 50)->nullable();
            $table->text('extra_billing_information')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('last_read_announcements_at')->nullable();
            $table->timestamps();
        });

        Schema::table('profiles', function($table) {
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
        Schema::table('profiles', function ($table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['avatar']);
            $table->dropForeign(['cover']);
        });

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('profiles');
        Schema::enableForeignKeyConstraints();
    }
}