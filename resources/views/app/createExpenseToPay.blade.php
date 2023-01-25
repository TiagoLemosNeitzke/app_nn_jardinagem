@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header mb-2 text-center bg-teal fw-bolder">
                @if (isset($expenseToPay))
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
           
                @if (isset($expenseToPay))
                    <form class="form-group" action="{{ route('expenseToPay.update', ['expenseToPay' => $expenseToPay]) }}" method="POST">
                        @method('PUT')
                        @csrf
                @else
                    <form class="form-group" action="{{ route('expenseToPay.store') }}" method="POST">
                        @csrf
                @endif
                    <input type="number" class="hidden" value="{{ $expenseToPay->user_id ?? Auth::user()->id }}" name="user_id">
                    <div class="mb-3">
                        <label for="expense_amount" class="form-label fw-bold">Valor da despesa</label>
                        <input type="number" class="form-control {{ $errors->first('expense_amount') ? 'border-danger' : '' }}" id="expense_amount" name="expense_amount"
                            placeholder="Somente números" value="{{ $expenseToPay->expense_amount ?? old('expense_amount') }}">
                        <span class="text-danger">{{ $errors->first('expense_amount') }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Descrição da despesa</label>
                        <textarea type="number" class="form-control {{ $errors->first('description') ? 'border-danger' : '' }}" id="description" name="description" placeholder="Descreva a despesa"
                            rows="3">{{ $expenseToPay->description ?? old('description') }}</textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label fw-bold">Data da vencimento da despesa</label>
                        <input class="form-control {{ $errors->first('due_date') ? 'border-danger' : '' }}" type="date" name="due_date" id="due_date" value="{{ $expenseToPay->due_date ?? old('due_date') }}">
                        <span class="text-danger">{{ $errors->first('due_date') }}</span>
                    </div>
                    <div class="container d-flex justify-content-end mt-4 mb-2">
                    
                        @if (isset($expenseToPay))
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="{{ route('expenseToPay.index') }}" class="btn btn-secondary ms-2">Voltar</a>
                        @elseif (isset($message))
                            <a href="{{ route('expenseToPay.index') }}" class="btn btn-success">Voltar</a>
                        @else
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                            <a href="{{ route('expenseToPay.index') }}" class="btn btn-secondary ms-2">Voltar</a>
                        @endif
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
