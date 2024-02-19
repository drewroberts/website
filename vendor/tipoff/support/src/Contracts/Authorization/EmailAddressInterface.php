<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Authorization;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface EmailAddressInterface extends AuthenticatableContract, AuthorizableContract, BaseModelInterface
{
}
