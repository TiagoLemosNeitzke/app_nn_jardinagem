@extends('layouts.app')

@section('formCustomer')

    @if (isset($error))
        <div class="row text-center">
            <p class="text-danger">{{ $error }}</p>
        </div>
    @endif

    <div class="justify-content-center d-flex bg-teal container mt-4">
        <div class="col-md-12 border-success mb-3">
            <div class="row text-center">
                <h5 class="bg-success text-light fw-bold pt-4 pb-4">
                    @if (isset($customer))
                        Editar dados do cliente
                    @else
                        Cadastrar Cliente
                    @endif
                </h5>
            </div>

            {{-- Form start --}}
            @if (isset($customer))
                <form class="row g-3 needs-validation mt-4"
                    action="{{ route('customer.update', ['customer' => $customer->id]) }}" method="post" novalidate>
                    @method('put')
                @else
                    <form class="row g-3 needs-validation mt-4" action="{{ route('customer.store') }}" method="post"
                        novalidate>
            @endif

            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row mb-3">
                <label for="inputId" class="col-sm-2 col-form-label">ID do Cliente</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputID" name="id"
                        value="{{ $customer->id ?? '' }}" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name"
                        value="{{ $customer->name ?? '' }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" name="email"
                        value="{{ $customer->email ?? '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputPhone" class="col-sm-2 col-form-label">Telefone</label>
                <div class="col-sm-10">
                    <input type="phone" class="form-control" id="inputPhone" name="phone"
                        value="{{ $customer->phone ?? '' }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputStreet" class="col-sm-2 col-form-label">Rua</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputStreet" name="street"
                        value="{{ $customer->street ?? '' }}" required>
                </div>
                <lebel class="col-form-label col-sm-2 pt-0" for="inputNumber">Numero</lebel>
                <div class="col-sm-2">
                    <input id="inputNumber" class="form-control" type="number" name="street_number"
                        value="{{ $customer->street_number ?? '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputDistrict" class="col-sm-2 col-form-label">Bairro</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDistrict" name="district"
                        value="{{ $customer->district ?? '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputCity" class="col-sm-2 col-form-label">Cidade</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputCity" name="city"
                        value="{{ $customer->city ?? '' }}">
                </div>

                <label for="inputState" class="col-sm-2 col-form-label">Estado</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="inputState" name="state"
                        value="{{ $customer->state ?? 'MS' }}">
                </div>
            </div>

            <div class="mb-3 pe-4">
                <button class="btn btn-success float-end fw-bold" type="submit">
                    @if (isset($customer))
                        Salvar
                    @else
                        Cadastrar
                    @endif

                </button>

                <a class="btn btn-outline-success float-end me-2" href="{{ route('customer.index') }}">Cancelar</a>
            </div>
            </form>
            {{-- form end --}}
        </div>
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>
    </div>
@endsection

{{-- 
                





 --}}
