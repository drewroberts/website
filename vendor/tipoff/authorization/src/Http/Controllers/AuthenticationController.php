<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tipoff\Authorization\Http\Requests\LoginRequest;
use Tipoff\Support\Http\Controllers\BaseController;

class AuthenticationController extends BaseController
{
    public function create()
    {
        return view('authorization::login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended();
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('email')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
