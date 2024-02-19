<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class TipoffAuthenticate extends Authenticate
{
    private array $guards = [];

    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    protected function redirectTo($request)
    {
        if (in_array('email', $this->guards)) {
            // Email only login is allowable
            return route('authorization.email-login');
        }

        // Full login required
        return route('authorization.login');
    }
}
