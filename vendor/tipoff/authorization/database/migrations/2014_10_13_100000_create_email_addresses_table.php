<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEmailAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('email_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->foreignIdFor(app('user'))->nullable();
            $table->boolean('primary')->default(false);
            $table->dateTime('verified_at')->nullable();
            $table->dateTime('undeliverable_at')->nullable(); // If email is undeliverable, need to change to update
            $table->timestamps();
        });

        // Direct SQL to avoid execution of custom attribute getter/setters
        $sql = <<<SQL
insert into email_addresses (`email`, `user_id`, `primary`, `verified_at`, `created_at`, `updated_at`)
select email, id, 1, email_verified_at, current_timestamp, current_timestamp from users
SQL;

        DB::insert($sql);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
        });
    }
}
