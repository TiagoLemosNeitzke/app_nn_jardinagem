@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mb-2 rounded text-center">
            @if (isset($message))
                <span class="fw-bold text-success p-2">
                    {{ $message }}
                </span>
            @elseif (isset($error))
                <span class="fw-bold text-danger p-2">
                    {{ $error }}
                </span>
            @endif
        </div>
        <div class="fixed-end mb-4">
            <a class="btn btn-success" href="{{ route('expenseToPay.create') }}">Cadastrar conta a pagar</a>
        </div>
        <div class="row justify-content-center">
            @foreach ($expenses as $expenseToPay)
                <div class="col-md-5 col-sm-12 my-2">
                    <div class="card">
                        <div class="card-header fw-bold bg-teal text-center">
                            @if ($expenseToPay->due_date <= date('Y-m-d', strtotime(now())))
                                <span class="text-danger fw-bold">Esta conta esta vencida</span>
                            @else
                                <span class="fw-bold">Esta conta ainda venceu</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <p><span class="fw-bold">Valor da despesa:</span> R$ {{ $expenseToPay->expense_amount }},00</p>
                            <p><span class="fw-bold">Descrição da despesa:</span> {{ $expenseToPay->description }}</p>

                            <p><span class="fw-bold">Data de vencimento:</span>
                                {{ date('d-m-Y', strtotime($expenseToPay->due_date)) }}</p>

                            <div class="col -text-center">
                                {{ $errors->first() }}
                                @if (!$expenseToPay->paid)
                                    <x-form route="expenseToPay.update" key="expenseToPay" id="{{ $expenseToPay->id }}"
                                        method="POST" http-verb="PATCH">
                                        <input class="hidden" type="text" name="paid" value="true">
                                        <x-button text="Marcar como pago" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                        </x-button>
                                    </x-form>
                                @endif

                                <x-link route="expenseToPay.edit" key="expenseToPay" id="{{ $expenseToPay->id }}"
                                    text="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </x-link>

                                <x-form route="expenseToPay.destroy" key="expenseToPay" id="{{ $expenseToPay->id }}"
                                    method="POST" http-verb="DELETE">
                                    <x-button text="Apagar" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </x-button>
                                </x-form>
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
                        <a class="page-link bg-teal text-dark" href="{{ $expenses->previousPageUrl() }}"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $expenses->lastPage(); $i++)
                        <li class="page-item {{ $expenses->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link bg-teal text-dark" href="{{ $expenses->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link bg-teal text-dark" href="{{ $expenses->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
