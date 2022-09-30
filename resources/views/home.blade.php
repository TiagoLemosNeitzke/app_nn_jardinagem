@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success fw-bold text-light text-center">{{ __('Dashboard') }}</div>

                    <div class="card-body bg-teal fs-3 text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Olá! {{ Auth::user()->name }}
                        {{ _('Você está logado!') }}
                    </div>
                </div>
            </div>
        </div>
        <main class="container">
            @yield('content')
        </main>
    </div>
@endsection
