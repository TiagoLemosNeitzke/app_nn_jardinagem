@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border">
                    <div class="card-header bg fw-bold text-light text-center">{{ __('Dashboard') }}</div>

                    <div class="card-body bg-teal fs-6 text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Olá! {{ Auth::user()->name }}.
                        {{ _('Bem vindo de volta!') }}
                    </div>

                </div>
            </div>
        </div>
        <main class="container">
            <div class="row mt-1">
                <div class="card bg-teal border">
                    <div class="card-body text-center">Você possui {{ $howManyCustomers }} cliente(s) cadastrado(s) no
                        sistema.</div>
                </div>
            </div>
            <div class="row mt-1 ">
                <div class="col-6">
                    <div class="card bg-teal mb-2 border">
                        <div class="card-body text-center">Você possui os seguintes agendamentos para hoje.</div>
                    </div>


                    @foreach ($tasksForToday as $task)
                        <div class="col mb-0 mb-2 rounded">
                            <div class="card  mt-2 mb-2">
                                <div class="card-body">

                                    <h6><span class="fw-bold">Cliente: </span>{{ $task->customer->name }}</h6>

                                    <p class="mb-0"><span class="fw-bold">Valor do serviço:</span> R$
                                        {{ $task->service_value }},00</p>

                                    <p><span class="fw-bold">Agendado para dia:</span>
                                        @php
                                            $date = explode('-', $task->scheduled_for_day);
                                            echo "$date[2]-$date[1]-$date[0]";
                                        @endphp
                                    </p>
                                    <div class="text-center">
                                        <a href="tel:{{ $task->customer->phone }}" class="btn btn-success">Ligar para cliente</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-6">
                    <div class="card bg-teal mb-2 border">
                        <div class="card-body text-center">As seguintes clientes ainda não pagaram.</div>
                    </div>

                    @foreach ($toReceives as $toReceive)
                        {{ $toReceive }}
                        <div class="card rounded">
                            <div class="card-body">
                                <p><span class="fw-bold">Cliente: </span>{{ $toReceive->customer->name }}</p>
                                <p><span class="fw-bold">Valor do serviço: </span>R$ {{ $toReceive->service_value }},00</p>
                                <p><span class="fw-bold">Serviço realizado dia: </span>{{ date('d-m-Y',strtotime($toReceive->created_at)) }}</p>
                                <div class="text-center">
                                    <a class="btn btn-success" href="tel:{{ $toReceive->customer->phone }}">Ligar para cliente</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </main>
    </div>
@endsection
