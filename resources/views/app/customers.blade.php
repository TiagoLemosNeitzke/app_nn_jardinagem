@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end container mb-1">
            <a class="btn btn-success" href="{{ route('customer.create') }}" title="Cadastrar cliente">Cadastrar Cliente</a>
        </div>
        <div class="row text-center">
            @if (isset($message))
                <p class="fw-bold fs-4 text-success">{{ $message }}</p>
                <div>
                    <a class="btn btn-success" href="{{ route('customer.index') }}">Voltar</a>
                </div>
            @elseif (isset($error))
                <p class="fw-bold fs-4 text-danger">{{ $error }}</p>
                <div>
                    <a class="btn btn-success" href="{{ route('customer.index') }}">Voltar</a>
                </div>
            @else
                <div class="border-bottom fs-4 mb-4 pb-2 text-center">
                    <span>Aqui estão listados todos os seus clientes.</span>
                </div>
            @endif
        </div>
        @if (isset($message) || isset($error))
            <div class="row hidden">
            @else
                <div class="row">

                    @if (isset($customers))
                        @foreach ($customers as $customer)
                            <div class="col-md-6 mb-2">
                                <div class="card">
                                    <div class="card-header fw-bold bg-teal text-center">Cliente</div>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold mb-4">{{ $customer->name }}</h5>
                                        <p><span class="fw-bold">Endereço:</span> {{ $customer->street }},
                                            {{ $customer->street_number }}.</p>
                                        <p><span class="fw-bold">Cidade:</span> {{ $customer->city }}.</p>
                                        <p><span class="fw-bold">Telefone:</span> {{ $customer->phone }} </p>

                                        <div class="row">
                                            <a href="{{ route('customer.show', ['customer' => $customer->id, 'user' => $customer->user->name]) }}"
                                                class="btn btn-success" title="Ver mais dados do cliente"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-person me-2" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                                </svg>
                                                Ver Mais
                                            </a>
                                        </div>

                                        <div class="row my-2">
                                            <a class="btn btn-primary"
                                                href="{{ route('customer.edit', ['customer' => $customer->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-pencil-square me-2"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>Editar</a>
                                        </div>

                                        <div class="mb-2">
                                            <form class="row" action="{{ route('customer.destroy', ['customer' => $customer]) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger w-100" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                    </svg>
                                                    Apagar
                                                </button>
                                            </form>
                                        </div>

                                        <div class="row">
                                            <a class="btn btn-success"
                                                href="{{ route('task.create', ['id' => $customer->id, 'name' => $customer->name]) }}"
                                                title="Realizar agendamento."><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="30" height="30" fill="currentColor" class="bi bi-bookmark"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                                </svg>
                                                Agendar
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                        <div class="d-flex justify-content-center mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link bg-teal text-light" href="{{ $customers->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    @for ($i = 1; $i <= $customers->lastPage(); $i++)
                                        <li class="page-item {{ $customers->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link bg-teal text-light"
                                                href="{{ $customers->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item">
                                        <a class="page-link bg-teal text-light" href="{{ $customers->nextPageUrl() }}"
                                            aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                    @endif
                </div>
        @endif

    </div>
@endsection
