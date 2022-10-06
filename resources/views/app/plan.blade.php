@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row text-center">
            @if (isset($error))
                <p class="fw-bold fs-4 text-danger">{{ $error }}</p>
                <a href="{{ route('plan.index') }}" class="btn btn-success btn-sm fw-bold mb-4">voltar</a>
            @endif
        </div>
        <div class="row">

            @if (isset($plans))
                @if ($filter === 'open')
                    <p class="text-center">Aqui são listados todos os chamados em aberto</p>
                @endif
                @if ($filter === 'done')
                    <p class="text-center">Aqui são listados todos os serviços já realizados</p>
                @endif
                @if ($filter === 'all')
                    <p class="text-center">Aqui são listados todos os chamados, incluindo os já realizados</p>
                @endif

                <div class="row">
                    <div class="fixed-end mb-4">
                        <ul class="nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="30" height="30" fill="currentColor" class="bi bi-funnel"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z" />
                                    </svg></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="{{ route('plan.index', ['filter' => 'open']) }}">Chamados abertos</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    <li><a class="dropdown-item"
                                            href="{{ route('plan.index', ['filter' => 'done']) }}">Serviços realizados</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                            </li>
                            <li><a class="dropdown-item" href="{{ route('plan.index', ['filter' => 'all']) }}">Todos
                                    os chamados</a>
                            </li>
                        </ul>
                        </li>
                        </ul>
                    </div>
                </div>
                @foreach ($plans as $plan)
                    <div class="col-sm-12 mb-2">
                        <div class="card border-success border">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-4">ID da tarefa: {{ $plan->id }}</h5>
                                <h6><b>ID do cliente: </b>{{ $plan->customer_id }}</h6>
                                <p><b>Cliente: </b>{{ $plan->customer->name }}</p>
                                <p><b>Endereço: </b>{{ $plan->customer->address }}</p>
                                <p><b>Telefone: </b>{{ $plan->customer->phone }}</p>
                                <p><b>Valor do serviço: </b>{{ $plan->customer->service_price }}</p>
                                <p class="{{ $plan->status ? 'text-success' : 'text-danger' }}"><b>Chamado aberto?
                                    </b>{{ $plan->status ? 'Sim' : 'Não' }}</p>
                                <p><b>Data da abertura do chamado: </b>{{ date_format($plan->created_at, 'd-m-y h:i:s') }}
                                </p>
                                <p><b>Data da realização do serviço:
                                    </b>{{ date_format($plan->updated_at, 'd-m-y h:i:s') }}
                                </p>
                                <div class="container">
                                    <form class="row" action="{{ route('plan.update', ['plan' => $plan->id]) }}"
                                        method="post">
                                        @method('put')
                                        @csrf
                                        {{-- <input type="number" name="id" value="{{ $plan->id }}" class="hidden"> --}}
                                        <button type="submit" class="btn btn-success"
                                            title="Marcar tarefa como realizada."><svg xmlns="http://www.w3.org/2000/svg"
                                                width="30" height="30" fill="currentColor"
                                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                            Marcar Realizado
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger w-100 mt-2"
                                        title="Retira a tarefa da fila."><svg xmlns="http://www.w3.org/2000/svg"
                                            width="30" height="30" fill="currentColor" class="bi bi-trash3"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        Apagar
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link bg-teal text-light" href="{{ $plans->previousPageUrl() }}"
                                    aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $plans->lastPage(); $i++)
                                <li class="page-item {{ $plans->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link bg-teal text-light"
                                        href="{{ $plans->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item">
                                <a class="page-link bg-teal text-light" href="{{ $plans->nextPageUrl() }}"
                                    aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
            @endif
        </div>
    </div>
@endsection
