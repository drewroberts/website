<?php

declare(strict_types=1);

namespace Tipoff\Authorization\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tipoff\Authorization\Http\Requests\RegisterRequest;
use Tipoff\Authorization\Models\EmailAddress;
use Tipoff\Authorization\Models\User;
use Tipoff\Support\Http\Controllers\BaseController;

class RegistrationController extends BaseController
{
    public function create()
    {
        return view('authorization::register');
    }

    public function store(RegisterRequest $request)
    {
        /** @var EmailAddress $email */
        $email = EmailAddress::query()->firstOrCreate([
            'email' => trim(strtolower($request->email)),
        ]);

        // TODO - error if email already has a user association?

        /** @var User $user */
        $user = User::query()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $email->user()->associate($user)->save();

        Auth::login($user);

        event(new Registered($user));

        return redirect('/');
    }
}
