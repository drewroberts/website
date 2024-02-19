<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class TipoffUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                Str::contains($this->firstCredentialKey($credentials), 'password'))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }

            if ($key === 'email') {
                $query->whereHas('emailAddresses', function (Builder $query) use ($key, $value) {
                    if (is_array($value) || $value instanceof Arrayable) {
                        $query->whereIn($key, $value);
                    } else {
                        $query->where($key, $value);
                    }
                });
            } else {
                if (is_array($value) || $value instanceof Arrayable) {
                    $query->whereIn($key, $value);
                } else {
                    $query->where($key, $value);
                }
            }
        }

        return $query->first();
    }
}
