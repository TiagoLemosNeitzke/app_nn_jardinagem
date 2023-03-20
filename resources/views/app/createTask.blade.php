@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center container mt-4">
        <div class="card">

            @if (isset($error))
                <div class="card-header bg-danger text-light fw-bold text-center">
                    <span>{{ $error }}</span>
                </div>
            @elseif (isset($message))
                <div class="card-header bg-success text-light fw-bold mb-4 text-center">
                    <span>{{ $message }}</span>
                </div>
            @else
                <div class="card-header bg-success text-light fw-bold text-center">
                    <span>Agendar</span>
                    <h5 class="card-title">Confirme os dados do cliente</h5>
                    <p>Após a confirmação dos dados clique no botão agendar e o cliente será adicionado a fila de espera.
                    </p>
                </div>
            @endif
            <div class="card-body">

                @if (isset($task))
                    <form class="form-group" action="{{ route('task.update', ['task' => $task->id]) }}" method="post">
                        @csrf
                        @method('put')
                    @else
                        <form class="form-group" action="{{ route('task.store') }}" method="post">
                            @csrf
                @endif
                @if (isset($task) || isset($customer))
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nome do cliente:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $task->customer->name ?? $customer->name }}" readonly>

                    </div>
                    <div class="mb-3">

                        <input type="number" class="hidden" id="id" name="customer_id"
                            value="{{ $task->customer_id ?? $customer->id }}">
                        <input type="number" class="hidden" id="id" name="user_id"
                            value="{{ $task->user_id ?? Auth::user()->id }}">

                    </div>

                    <div class="mb-3">
                        <label for="scheduled_for_day" class="form-label fw-bold">Agendar para dia:</label>
                        <input type="date" class="form-control" id="scheduled_for_day" name="scheduled_for_day"
                            value="{{ $task->scheduled_for_day ?? '' }}">
                        <span class="text-danger fs-6">{{ $errors->first('scheduled_for_day') }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="service_value" class="form-label fw-bold">Valor do Serviço (em centavos):</label>
                        <input type="text" class="form-control" id="service_value" name="service_value"
                            value="{{ $task->service_value ?? '' }}">

                        <span class="text-danger fs-6">{{ $errors->first('service_value') }}</span>

                    </div>
                @endif

                @if (isset($task))
                    <button class="btn btn-success" type="submit">Salvar</button>
                @elseif(isset($customer))
                    <button type="submit" class="btn btn-success" title="Salvar agendamento">Agendar</button>
                @endif

                <div class="text-center">
                    <a class="btn btn-secondary" href="{{ $url }}" title="Voltar">Voltar</a>
                </div>

                </form>
            </div>
        </div>
    </div>
@endsection
