<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Contracts\Role;

class AddRoles extends Migration
{
    public function up()
    {
        if (app()->has(Role::class)) {
            foreach ([
                'Admin',
                'Owner',
                'Executive',
                'Staff',
                'Former Staff',
                'Customer',
            ] as $name) {
                app(Role::class)::findOrCreate($name, null);
            };
        }
    }
}
