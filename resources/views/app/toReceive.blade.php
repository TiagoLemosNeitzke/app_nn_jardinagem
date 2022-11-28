@extends('layouts.app')
@section('content')
    <div class="container">


        @foreach ($toReceives as $toReceive)
        
            <div class="col-sm-12 mb-2">
                <div class="card border-success border">
                    <div class="card-body">

                        <h6 class="fw-bold">Cliente: {{ $toReceive->customer->name }}</h6>
                        <p class="fw-bold">Valor do serviço: R$ {{ $toReceive->value }}</p>
                        <p class="{{ $toReceive->paid_out ? 'text-success' : 'text-danger' }}"><b>Serviço foi pago?
                            </b>{{ $toReceive->paid_out ? 'Sim' : 'Não' }}</p>
                        <p class="fw-bold">Serviço realizado em: {{ date_format($toReceive->created_at, 'd-m-y h:i:s') }}
                        </p>

                        <div class="container">

                            <form class="row" action="{{ route('toReceive.update', ['toReceive' => $toReceive->id]) }}"
                                method="post">
                                @method('put')
                                @csrf
                                <button type="submit" class="btn btn-success" title="Marcar tarefa como realizada."><svg
                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-check2-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                        <path
                                            d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                    </svg>
                                    Marcar Como Pago
                                </button>
                            </form>
                            <div class="row">
                                <a href="{{ route('customer.show', ['customer' => $toReceive->customer->id]) }}"
                                    class="btn btn-success w-100 mt-2" title="Ver mais dados do cliente"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-person" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                    Ver Mais Dados do Cliente
                                </a>
                            </div>
                            <div class="row">
                                <button type="button" class="btn btn-danger w-100 mt-2"
                                    title="Retira a tarefa da fila."><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg>
                                    Apagar Registro
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        @endforeach
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
                        <a class="page-link bg-teal text-light" href="{{ $toReceives->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
