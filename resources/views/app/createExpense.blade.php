@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header mb-2 text-center bg-teal fw-bolder">
                @if (isset($expense))
                    Edite os campos abaixo e depois clique em salvar
                @elseif (isset($error))
                     <span class="text-danger">{{ $error }}</span>
                @elseif (isset($message))
                    <span class="text-success">{{ $message }}</span>
                @else
                    Preencha os campos abaixo para cadastrar uma nova despesa 
                @endif

            </div>
            <div class="card-body">
                @if (isset($expense))
                    <form class="form-group" action="{{ route('expense.update', ['expense' => $expense]) }}" method="POST">
                        @method('put')
                        @csrf
                @else
                    <form class="form-group" action="{{ route('expense.store') }}" method="POST">
                        @csrf
                @endif
                
                    {{ $errors->first() }}
                    <input type="number" class="hidden" value="{{ $expense->user_id ?? Auth::user()->id }}" name="user_id">
                    <div class="mb-3">
                        <label for="expense_amount" class="form-label fw-bold">Valor da despesa</label>
                        <input type="number" class="form-control {{ $errors->first('expense_amount') ? 'border-danger' : '' }}" id="expense_amount" name="expense_amount"
                            placeholder="Somente números" value="{{ $expense->expense_amount ?? old('expense_amount') }}">
                        <span class="text-danger">{{ $errors->first('expense_amount') }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Descrição da despesa</label>
                        <textarea type="number" class="form-control {{ $errors->first('description') ? 'border-danger' : '' }}" id="description" name="description" placeholder="Descreva a despesa"
                            rows="3">{{ $expense->description ??old('description') }}</textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="date_expense" class="form-label fw-bold">Data da despesa</label>
                        <input class="form-control {{ $errors->first('date_expense') ? 'boder-danger' : '' }}" type="date" name="date_expense" id="date_expense" value="{{ $expense->date_expense ?? old('date_expense') }}">
                        <span class="text-danger">{{ $errors->first('date_expense') }}</span>
                    </div>
                    <div class="container d-flex justify-content-end mt-4 mb-2">
                        @if (isset($expense))
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="{{ route('expense.index') }}" class="btn btn-secondary ms-2">Voltar</a>
                        @elseif (isset($message))
                            <a href="{{ route('expense.index') }}" class="btn btn-success">Voltar</a>
                        @else
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                            <a href="{{ route('expense.index') }}" class="btn btn-secondary ms-2">Voltar</a>
                        @endif
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
