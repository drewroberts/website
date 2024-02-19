<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Traits;

use Illuminate\Support\Facades\Auth;
use Tipoff\Authorization\Models\User;

trait UsesTipoffAuthentication
{
    public function getEmailAddressId(): ?int
    {
        if (Auth::guard('email')->check()) {
            return (int) Auth::guard('email')->id();
        }

        if (Auth::guard('web')->check()) {
            /** @var User $user */
            $user = Auth::guard('web')->user();

            $emailAddress = $user->getPrimaryEmailAddress();

            return $emailAddress ? $emailAddress->id : null;
        }

        return null;
    }
}
