@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border">
                    <div class="card-header bg fw-bold text-light text-center">
                        {{ __('Dashboard') }}
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
            <div class="d-md-flex justify-content-between">
                <div class="col-md-5 col-sm-12 mt-2">
                    <div class="card bg-teal mb-2 border">
                        <div class="card-body text-center">Você possui os seguintes agendamentos para hoje.</div>
                    </div>


                    @foreach ($tasksForToday as $task)
                        <div class="col col-sm-12 mb-0 mb-2 rounded">
                            <div class="card mt-2 mb-2">
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
                                        <a href="tel:{{ $task->customer->phone }}" class="btn btn-success">Ligar para
                                            cliente</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-5 col-sm-12 mt-2">
                    <div class="card bg-teal mb-2 border">
                        <div class="card-body text-center">As seguintes clientes ainda não pagaram.</div>
                    </div>

                    @foreach ($toReceives as $toReceive)
                        <div class="card mb-2 rounded">
                            <div class="card-body">
                                <p><span class="fw-bold">Cliente: </span>{{ $toReceive->customer->name }}</p>
                                <p><span class="fw-bold">Valor do serviço: </span>R$ {{ $toReceive->service_value }},00</p>
                                <p><span class="fw-bold">Serviço realizado dia:
                                    </span>{{ date('d-m-Y', strtotime($toReceive->created_at)) }}</p>
                                <div class="text-center">
                                    <a class="btn btn-success w-100 mb-2" href="tel:{{ $toReceive->customer->phone }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                            height="25" fill="currentColor" class="bi bi-telephone-outbound me-2"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                        Ligar para cliente
                                    </a>

                                    <form action="{{ route('toReceive.update', ['toReceive' => $toReceive->id]) }}"
                                        method="post">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="btn btn-success w-100"
                                            title="Marcar tarefa como realizada."><svg xmlns="http://www.w3.org/2000/svg"
                                                width="30" height="30" fill="currentColor"
                                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                            Marcar Pago
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link bg-teal text-light" href="{{ $toReceives->previousPageUrl() }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $toReceives->lastPage(); $i++)
                            <li class="page-item {{ $toReceives->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link bg-teal text-light"
                                    href="{{ $toReceives->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item">
                            <a class="page-link bg-teal text-light" href="{{ $toReceives->nextPageUrl() }}"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main>
    </div>
@endsection
