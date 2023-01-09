@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row bg-success mb-2 rounded text-center">
            @if (isset($message))
                <div class="fw-bold p-2 text-white">
                    {{ $message }}
                </div>
            @endif
        </div>
        <div class="fixed-end">
            <a class="btn btn-success" href="{{ route('expense.create') }}">Cadastrar despesa</a>
        </div>
        <div class="row">
            @foreach ($expenses as $expense)
                <div class="col-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <p><span class="fw-bold">Valor da despesa:</span> R$ {{ $expense->expense_amount }},00</p>
                            <p><span class="fw-bold">Descrição da despesa:</span> {{ $expense->description }}</p>
                            <p><span class="fw-bold">Data da despesa:</span>
                                {{ date('d-m-Y', strtotime($expense->date_expense)) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
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
    </div>
@endsection
