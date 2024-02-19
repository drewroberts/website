
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <livewire:styles />
    </head>
    <body class="body">
        <div id="app" class="website">
            @include('support::partials.header')

            <div class="website-wrapper">

                <main class="main">
                    @yield('content')

                    @include('support::partials.menu')
                </main>

                @include('support::partials.footer')
            </div>
        </div>

        <livewire:scripts />
    </body>
</html>
