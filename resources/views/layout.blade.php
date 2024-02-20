<!doctype html>
    <html lang="en">
<head>
    <meta charset="utf-8" />

    @if (isset($noindex))
        <meta name="robots" content="noindex">
    @endif

    @if (request()->getHttpHost() !== 'thegreatescaperoom.com')
        <meta name="robots" content="noindex">
    @endif

    <title>{{ $seotitle ?? 'Drew Roberts' }}</title>
    <meta name="description" content="{{ $seodescription ?? 'ORLANDO, FL - Drew Roberts enjoys web development and is passionate about growth marketing. Welcome to my little home on the internet, DrewRoberts.com.' }}" />
    <link rel="canonical" href="{{ $canonical ?? ''}}" />
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#000000">
    <meta name="apple-mobile-web-app-title" content="Drew Roberts">
    <meta name="application-name" content="Drew Roberts">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="theme-color" content="#000000">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @section('styles')
        {{ File::get( public_path('css/app.css') ) }}
    @show
    </style>

</head>
<body>

    <div id="app" class="">
        @include('partials.header')

        <div class="wrapper">

            <main class="main">
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </div>
</body>
</html>