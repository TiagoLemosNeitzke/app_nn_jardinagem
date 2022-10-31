@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center container mt-4">
        <div class="card">
            
            @if (isset($error))
                <div class="card-header bg-danger text-light fw-bold text-center">
                    {{ $error }}
                </div>
            @elseif (isset($message))
                <div class="card-header bg-success text-light fw-bold text-center mb-4">
                    {{ $message}}
                </div>
            @else
                <div class="card-header bg-success text-light fw-bold text-center">
                    Agendar
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">Busque pelo cadastro do cliente preenchendo um dos campos abaixo</h5>
                <p>Após a confirmação dos dado o cliente será adicionado a fila de espera.</p>
                <form class="needs-validation" novalidate action="{{ route('plan.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nome do cliente:</label>
                        <input type="text" class="form-control" id="name" aria-describedby="idHelpName"
                            name="name" value="{{ $name ?? '' }}">
                        <div id="idHelpName" class="form-text">Preencha este campo caso queira buscar por nome do cliente.
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="id" class="form-label fw-bold">Id do cliente:</label>
                        <input type="number" class="form-control" id="id" aria-describedby="idHelp"
                            name="customer_id" value="{{ $id ?? '' }}">
                        <div id="idHelp" class="form-text">Preencha este campo caso queira buscar pelo ID do cliente
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Agendar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
