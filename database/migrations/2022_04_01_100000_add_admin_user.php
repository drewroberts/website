<?php

use Illuminate\Database\Migrations\Migration;
use Tipoff\Authorization\Models\EmailAddress;
use Tipoff\Authorization\Models\User;

class AddAdminUser extends Migration
{
    public function up()
    {
        $user = User::factory()->admin()->create([
            'first_name' => 'Drew',
            'last_name' => 'Roberts',
            'username' => 'drewroberts',
            'password' => bcrypt('password'),
        ]);

        EmailAddress::factory()->create([
            'email' => 'drew@drewroberts.com',
            'user_id' => $user->id,
        ]);
    }
}
