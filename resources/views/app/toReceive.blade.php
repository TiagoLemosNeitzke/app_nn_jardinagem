@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="border-bottom mb-2 text-center">
            <p>Aqui estão todos os seus serviços realizados</p>
        </div>
        <div class="row mb-2 text-center">
            @if (isset($message))
                <p class="text-success">{{ $message }}</p>
            @endif

            @if (isset($error))
                <p class="text-danger">{{ $error }}</p>
            @endif
        </div>

        <div class="col text-center">
            @foreach ($toReceives as $toReceive)
                <div class="d-md-inline-flex my-2">
                    <div class="card border">
                        <div class="card-body">

                            <h6><span class="fw-bold">Cliente: </span>{{ $toReceive->customer->name }}</h6>
                            <p><span class="fw-bold">Valor do serviço: </span>R$ {{ $toReceive->service_value }}</p>
                            <p><span class="fw-bold">Serviço foi pago?</span>
                                @if ($toReceive->status)
                                    <span class="text-success">Sim</span>
                                @else
                                    <span class="text-danger">Não</span>
                                @endif
                            </p>
                            <p class="fw-bold">Serviço realizado em:
                                {{ date_format($toReceive->created_at, 'd-m-y h:i:s') }}
                            </p>
                            @if (!$toReceive->status)
                                <div class="">
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
                                <div class="mt-2">

                                    <a class="btn btn-success w-100" href="tel:{{ $toReceive->customer->phone }}"
                                        title="Ligar para o cliente"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                            height="25" fill="currentColor" class="bi bi-telephone-outbound me-2"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                        Ligar para cliente
                                    </a>

                                </div>
                            @endif

                            <div class="">
                                <a href="{{ route('customer.show', ['customer' => $toReceive->customer->id]) }}"
                                    class="btn btn-success w-100 mt-2" title="Ver mais dados do cliente"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-person" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                    Dados do cliente
                                </a>
                            </div>
                            <div class="">
                                <form action="{{ route('toReceive.destroy', $toReceive->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger w-100 mt-2"
                                        title="Retira a tarefa da fila."><svg xmlns="http://www.w3.org/2000/svg"
                                            width="30" height="30" fill="currentColor" class="bi bi-trash3"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        Apagar Registro
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
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
                        <a class="page-link bg-teal text-light" href="{{ $toReceives->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
