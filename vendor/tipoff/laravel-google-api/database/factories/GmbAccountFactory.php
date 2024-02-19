<?php

declare(strict_types=1);

namespace Tipoff\GoogleApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\GoogleApi\Models\GmbAccount;

class GmbAccountFactory extends Factory
{
    protected $model = GmbAccount::class;

    public function definition()
    {
        return [
            'account_number' => $this->faker->unique()->slug,
            'key_id'         => randomOrCreate(app('key')),
            'creator_id'     => randomOrCreate(app('user')),
            'updater_id'     => randomOrCreate(app('user')),
        ];
    }
}
