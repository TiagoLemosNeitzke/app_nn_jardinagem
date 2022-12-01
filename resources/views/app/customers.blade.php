@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row text-center">
            @if (isset($message))
                <p class="fw-bold fs-4 text-success">{{ $message }}</p>
                <div>
                    <a class="btn btn-outline-success" href="{{ route('customer.index') }}">Voltar</a>
                </div>
            @elseif (isset($error))
                <p class="fw-bold fs-4 text-danger">{{ $error }}</p>
                <div>
                    <a class="btn btn-outline-success" href="{{ route('customer.index') }}">Voltar</a>
                </div>
            @else
                <div class="row">
                    
                        <div class="mb-2 text-center">
                            <h4>Aqui estão listados todos os seus clientes.</h4>
                        </div>
                   

                </div>
            @endif
        </div>
        <div class="row">

            @if (isset($customers))
                @foreach ($customers as $customer)
                    <div class="col-sm-6 mb-2">
                        <div class="card border-dark border">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-4">{{ $customer->name }}</h5>
                                <h6><b>ID: </b>{{ $customer->id }}</h6>
                                <a href="{{ route('customer.show', ['customer' => $customer->id, 'user' => $customer->user->name]) }}"
                                    class="btn btn-outline-success" title="Ver mais dados do cliente"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-person me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                    Ver Mais
                                </a>

                                <a class="btn btn-outline-success"
                                    href="{{ route('customer.edit', ['customer' => $customer->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>Editar</a>
                                <a class="btn btn-outline-success"
                                    href="{{ route('task.store', ['id' => $customer->id, 'name' => $customer->name]) }}"
                                    title="Realizar agendamento."><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                        height="30" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                                        <path
                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                    </svg>
                                    Agendar
                                </a>
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

    </div>
@endsection
