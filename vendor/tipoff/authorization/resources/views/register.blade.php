@extends('support::base')

@section('content')
    <h2>REGISTER</h2>
    @include('support::partials._errors')

    <form method="POST" action="{{ route('authorization.register') }}">
        @csrf

        <div>
            <label for="first_name">{{__('First Name')}}</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus/>
        </div>

        <div>
            <label for="last_name">{{__('Last Name')}}</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required/>
        </div>

        <div>
            <label for="email">{{__('Email')}}</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}" required/>
        </div>

        <div>
            <label for="username">{{__('Username')}}</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required/>
        </div>

        <div>
            <label for="password">{{__('Password')}}</label>
            <input type="password" id="password" name="password" required autocomplete="new-password"/>
        </div>

        <div>
            <label for="password_confirmation">{{__('Confirm Password')}}</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required/>
        </div>

        <div>
            <a href="{{ route('authorization.login') }}">{{ __('Already registered?') }}</a>
            <button type="submit">{{ __('Register') }}</button>
        </div>
    </form>
@endsection
