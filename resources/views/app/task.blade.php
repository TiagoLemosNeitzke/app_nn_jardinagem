@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row text-center">

            @if (isset($error))
                <p class="fw-bold fs-4 text-danger">{{ $error }}</p>
                <a href="{{ route('task.index') }}" class="btn btn-success btn-sm fw-bold mb-4">voltar</a>
            @endif

            @if (isset($message))
                <p class="fw-bold fs-4 text-success">{{ $message }}</p>
                <a href="{{ route('task.index') }}" class="btn btn-success btn-sm fw-bold mb-4">voltar</a>
            @endif
        </div>
        <div class="row">
        </div>
        <div class="fixed-end mb-4">
            <a class="btn btn-success"data-bs-toggle="modal" data-bs-target="#notificationModal">Agendar serviço</a>
        </div>
        @if (isset($tasks))
            <div class="row border-bottom mb-4">
                <div class="fixed-end mb-4">
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#"
                                role="button" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                    height="30" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                                    <path
                                        d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z" />
                                </svg></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('task.index', ['filter' => 'open']) }}">Chamados
                                        abertos</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                <li><a class="dropdown-item" href="{{ route('task.index', ['filter' => 'done']) }}">Serviços
                                        realizados</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                        </li>
                        <li><a class="dropdown-item" href="{{ route('task.index', ['filter' => 'all']) }}">Todos
                                os chamados</a>
                        </li>
                    </ul>
                    </li>
                    </ul>
                </div>
            </div>
            @foreach ($tasks as $task)
                <div class="col-sm-4 mb-2">
                    <div class="card">
                        <div class="card-header fw-bold bg-teal text-center">Serviço</div>
                        <div class="card-body">

                            <h6 class="fw-bold">Cliente: {{ $task->customer->name }}</h6>

                            {{-- to do: melhorar como armazeno e exibo o valor do serviço --}}
                            <p class="fw-bold">Valor do serviço: R$ {{ $task->service_value }},00</p>

                            <p class="fw-bold {{ $task->did_day ? 'text-danger' : 'text-success' }}">Chamado aberto?

                                @if ($task->did_day === null)
                                    Sim
                                @else
                                    Não
                                @endif
                            </p>

                            @if ($task->did_day !== null)
                                <p class="fw-bold">
                                    Serviço realizado dia: @php
                                        $date = explode('-', $task->did_day);
                                        echo "$date[2]-$date[1]-$date[0]";
                                    @endphp
                                </p>
                            @endif

                            <p class="fw-bold">Agendado para dia:
                                @php
                                    $date = explode('-', $task->scheduled_for_day);
                                    echo "$date[2]-$date[1]-$date[0]";
                                @endphp
                            </p>
                            <div class="container">

                                <form action="{{ route('task.done', ['task' => $task]) }}" method="put">
                                    @method('put')
                                    @csrf
                                    <input type="number" name="id" value="{{ $task->id }}" class="hidden">
                                    @if ($task->did_day === null)
                                        <button type="submit" class="btn btn-success w-100"
                                            title="Marcar tarefa como realizada."><svg xmlns="http://www.w3.org/2000/svg"
                                                width="30" height="30" fill="currentColor"
                                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                            Realizado
                                        </button>
                                    @endif
                                </form>
                                @if ($task->did_day === null)
                                    <a class="btn btn-primary w-100 mt-2"
                                        href="{{ route('task.edit', ['task' => $task->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>Editar</a>
                                @endif
                                <form action="{{ route('task.destroy', $task->id) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100 mt-2"
                                        title="Retira a tarefa da fila."><svg xmlns="http://www.w3.org/2000/svg"
                                            width="30" height="30" fill="currentColor" class="bi bi-trash3"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        Apagar
                                    </button>
                                </form>

                                <form action="{{ route('customer.show', ['customer' => $task->customer_id]) }}"
                                    method="get">

                                    @csrf
                                    <button type="submit" class="btn btn-success w-100 mt-2"
                                        title="Consulta dados do cliente."><svg xmlns="http://www.w3.org/2000/svg"
                                            width="30" height="30" fill="currentColor" class="bi bi-search"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                        Dados do cliente
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link bg-teal text-light" href="{{ $tasks->previousPageUrl() }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                            <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link bg-teal text-light"
                                    href="{{ $tasks->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item">
                            <a class="page-link bg-teal text-light" href="{{ $tasks->nextPageUrl() }}"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
        @endif
    </div>
    {{-- Modal create task instru --}}
    <div class="modal fade modal-lg" id="notificationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title fw-bold text-light" id="exampleModalLabel">Siga as instruções para agendar um serviço</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Clique no menu <span class="fw-bold">Clientes > Todos os clientes</span></li>
                        <li>Clique no botão <span class="fw-bold">agendar</span> no card do cliente que você deseja criar o agendamento</li>
                        <li>Preencha no campo <span class="fw-bold">Agendar para dia</span> escolhendo a data no calendário no canto direito</li>
                        <li>Preencha no campo <span class="fw-bold">Valor do serviço</span> coloque somente números, sem virgulas ou pontos</li>
                        <li>Clique em <span class="fw-bold">Agendar</span></li>
                        <li>Caso algum campo esteja preenchido incorretamente você deverá receber uma mensagem de erro, corrija o erro e envie novamente o formulário clicando em <span class="fw-bold">Agendar</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal create task instruction --}}
    </div>
@endsection
