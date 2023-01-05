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
                <h5 class="card-title">Confirme os dados do cliente</h5>
                <p>Após a confirmação dos dados clique no botão agendar e o cliente será adicionado a fila de espera.</p>
                
                <form class="form-group" action="{{ route('task.store') }}" method="post">
                    @csrf                      
                   
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nome do cliente:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $name ?? '' }}" readonly>

                    </div>
                    <div class="mb-3">
                       
                        <input type="number" class="form-control hidden" id="id" aria-describedby="idHelp"
                            name="customer_id" value="{{ $id ?? '' }}" readonly>
                        <input type="number" class="form-control hidden" id="id" aria-describedby="idHelp"
                            name="user_id" value="{{ Auth::user()->id}}" readonly>
                       
                    </div>

                    <div class="mb-3">
                        <label for="scheduled_for_day" class="form-label fw-bold">Agendar para dia:</label>
                        <input type="date" class="form-control" id="scheduled_for_day" name="scheduled_for_day" value="{{ $scheduled_for_day ?? '' }}" required>
                       <span class="text-danger fs-6">{{ $errors->first('scheduled_for_day') }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="service_value" class="form-label fw-bold">Valor do Serviço (somente números):</label>
                        <input type="text" class="form-control" id="service_value" name="service_value" value="{{ $service_value ?? '' }}" required>
                        
                        <span class="text-danger fs-6">{{ $errors->first('service_value') }}</span> 
                        
                    </div>
                    @if(isset($message))
                        <button type="submit" class="btn btn-success" title="Salvar agendamento">Agendar</button>
                    @endif
                    <a class="btn btn-outline-secondary" href="{{ route('customer.index') }}" title="Voltar">Voltar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
