@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center container mt-4">
        <div class="card">
            @if (isset($error))
                <div class="card-header bg-danger text-light fw-bold text-center">
                    {{ $error }}
                </div>
            @else
                <div class="card-header bg-success text-light fw-bold text-center">
                    Agendar
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">Preeencha o campo abaixo para realizar o agendamento</h5>
                <p>O cliente será adicionado a fila de espera.</p>
                <form class="needs-validation" novalidate action="{{ route('plan.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="id" class="form-label fw-bold">Cliente:</label>
                        <input type="text" class="form-control" id="id" aria-describedby="idHelp"
                            name="customer_id" value="{{ $name ?? '' }}" readonly>
                        <div id="idHelp" class="form-text">Este campo é preenchido automaticamente. Se estiver vazio não
                            precisa preencher.</div>

                    </div>
                    <div class="mb-3">
                        <label for="id" class="form-label fw-bold">Id do cliente:</label>
                        <input type="number" class="form-control" id="id" aria-describedby="idHelp"
                            name="customer_id" value="{{ $id ?? '' }}" required>
                        <div id="idHelp" class="form-text">Se você não sabe o ID do cliente use o campo de pesquisa na
                            barra de menu.</div>
                    </div>
                    <button type="submit" class="btn btn-success">Agendar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
