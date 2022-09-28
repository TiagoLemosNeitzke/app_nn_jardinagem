@extends('layouts.app')

@section('content')
    <header class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success fw-bold text-light text-center">{{ __('Dashboard') }}</div>

                    <div class="card-body bg-teal">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="container-fluid justify-content-center">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-lg-0mb-2">
                                        <li class="nav-item">
                                            <a class="nav-link fw-bold text-light btn btn-success me-2" aria-current="page"
                                                href="#">Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-bold text-light btn btn-success me-2" href="#">À
                                                Receber</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-bold text-light btn btn-success me-2" href="#">À
                                                Pagar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-bold text-light btn btn-success me-2"
                                                href="#">Registrar
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

                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>
@endsection
