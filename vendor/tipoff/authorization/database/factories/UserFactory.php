<?php


namespace Tipoff\Authorization\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Authorization\Models\User;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'            => $this->faker->firstName,
            'last_name'             => $this->faker->lastName,
            'password'              => bcrypt('password'),
            'remember_token'        => Str::random(10),
        ];
    }

    /**
     * Assign a user as an admin
     *
     * @return UserFactory
     */
    public function admin()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('Admin');
        });
    }

    /**
     * Assign a user based on a role input
     *
     * @param string $role
     * @return UserFactory
     */
    public function role($role)
    {
        return $this->afterCreating(function (User $user) use ($role) {
            $user->assignRole($role);
        });
    }
}
