<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Style -->
    <style>
        .hover-text-white:hover{
            color: #fff !important;

        }
    </style>
</head>

<body>
    <header class="border-bottom">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand ps-4" href="{{ route('welcome') }}">{{ config('app.name') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-lg-0 mb-2">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ Route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                    </ul>
                    <nav class="navbar navbar-expand-lg">

                        @if (Route::has('login'))
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    @auth
                                        <li class="nav-item">
                                            <a href="{{ url('/home') }}" class="nav-link btn btn-outline-success">Home</a>
                                        </li>
                                    @else
                                        <li class="nav-item mb-2">
                                            <a href="{{ route('login') }}" class="nav-link btn btn-outline-success mx-md-2 text-success hover-text-white">Entrar</a>
                                        </li>

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a href="{{ route('register') }}"
                                                    class="nav-link btn btn-success text-white">Registrar</a>
                                            </li>
                                        @endif
                                    @endauth
                                </ul>
                            </div>
                        @endif
                    </nav>
                </div>
        </nav>
    </header>

</body>

</html>
