@extends('support::base')

@section('content')
    <h2>LOGIN</h2>
    @include('support::partials._errors')

    <form method="POST" action="{{ route('authorization.login') }}">
        @csrf
        <div>
            <label for="username">{{__('Username')}}</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus/>
        </div>
        <div>
            <label for="password">{{__('Password')}}</label>
            <input type="password" id="password" name="password" required/>
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
        </div>

        <div>
            <a href="{{ route('authorization.register') }}">{{ __('Register') }}</a>
        </div>

        <button type="submit">{{ __('Login') }}</button>
    </form>
@endsection
