@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header mb-2 text-center bg-teal fw-bolder">Preencha os campos abaixo para cadastrar uma nova despesa</div>
            <div class="card-body">
                <form class="form-group" action="{{ route('expense.store') }}" method="POST">
                    @csrf
                    {{ $errors->first() }}
                    <input type="number" class="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <div class="mb-3">
                        <label for="expense_amount" class="form-label fw-bold">Valor da despesa</label>
                        <input type="number" class="form-control {{ $errors->first('expense_amount') ? 'border-danger' : '' }}" id="expense_amount" name="expense_amount"
                            placeholder="Somente números" value="{{ old('expense_amount') }}">
                        <span class="text-danger">{{ $errors->first('expense_amount') }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Descrição da despesa</label>
                        <textarea type="number" class="form-control {{ $errors->first('description') ? 'border-danger' : '' }}" id="description" name="description" placeholder="Descreva a despesa"
                            rows="3">{{ old('description') }}</textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="date_expense" class="form-label fw-bold">Data da despesa</label>
                        <input class="form-control {{ $errors->first('date_expense') ? 'boder-danger' : '' }}" type="date" name="date_expense" id="date_expense" value="{{ old('date_expense') }}">
                        <span class="text-danger">{{ $errors->first('date_expense') }}</span>
                    </div>
                    <div class="container d-flex justify-content-end mt-4 mb-2">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
