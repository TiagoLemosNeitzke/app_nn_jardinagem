<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Style -->
    <style>
        .btn-link-success {
            color: #198754;
            text-decoration: none;
        }

        .btn-link-success:hover {
            color: #20c997;
        }

        .bg-teal {
            background-color: #20c997;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
            <div class="container">
                <a class="navbar-brand text-light fw-bolder" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end bg-success" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item fw-bold text-light" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @auth
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-lg-0mb-2">
                            <li class="nav-item dropdown fw-bold btn btn-success me-2 btn-sm">
                                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Clientes
                                </a>
                                <ul class="dropdown-menu bg-success" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item text-light" href="{{ route('customer.index') }}">Todos os
                                            clientes</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider bg-light">
                                    </li>
                                    <li><a class="dropdown-item text-light"
                                            href="{{ route('customer.create') }}">Cadastrar</a></li>
                                </ul </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-light btn btn-success me-2" href="#">À
                                    Receber</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-light btn btn-success me-2" href="#">À
                                    Pagar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-light btn btn-success me-2" href="#">Registrar
                                    Despesa</a>
                            </li>


                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Buscar Cliente"
                                aria-label="Search">
                            <button class="btn btn-success fw-bold" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        @endauth


        <main class="py-4">
            @yield('content')
            @yield('customer')
            @yield('registerCustomer')
        </main>
    </div>
</body>

</html>
