@extends('layouts.app')

@section('formCustomer')
    {{ $customer }}
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
                        value="{{ $customer->email ?? '' }}" required>
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
                <label for="inputAddress" class="col-sm-2 col-form-label">Endereço</label>
                <div class="col-sm-10">
                    <input type="phone" class="form-control" id="inputAddress" name="address"
                        value="{{ $customer->address ?? '' }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Qual é o serviço?</legend>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Qual é o serviço?" required name="type_service">
                        <option selected>{{ $customer->type_service ?? '' }}</option>
                        <option value="Jardinagem">Jardinagem</option>
                        <option value="Piscina">Piscina</option>
                        <option value="Jardinagem|Piscina">Jardinagem|Piscina</option>
                    </select>
                </div>

            </div>

            <div class="row mb-3">
                <label for="inputPrice" class="col-sm-2 col-form-label">Valor do serviço</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPrice" name="service_price"
                        value="{{ $customer->service_price ?? '' }}" required>
                </div>
            </div>

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">É mensalidade?</legend>
                <div class="col-sm-10">

                    @if (isset($customer->is_monthly))
                        {{-- If is monthly I am check the radio --}}
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="gridRadios1" value="1" required
                                name="is_monthly" checked>

                            <label class="form-check-label" for="gridRadios1">
                                @if ($customer->is_monthly)
                                    Sim
                                @else
                                    Não
                                @endif
                            </label>

                        </div>
                        {{-- I am printing the other option --}}
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="gridRadios1" value="0" required
                                name="is_monthly">

                            <label class="form-check-label" for="gridRadios1">
                                @if ($customer->is_monthly)
                                    Não
                                @else
                                    Sim
                                @endif
                            </label>

                        </div>
                    @else
                        {{--  --}}
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="gridRadios1" value="1" required
                                name="is_monthly" checked>

                            <label class="form-check-label" for="gridRadios1">
                                Sim
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="gridRadios2" value="0" required
                                name="is_monthly">
                            <label class="form-check-label" for="gridRadios2">
                                Não
                            </label>
                        </div>
                    @endif
            </fieldset>
            <div class="row mb-3">
                <label for="inputExpiration" class="col-sm-2 col-form-label">Mensalidade vence dia?</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputExpiration" name="expiration_day"
                        value="{{ $customer->expiration_day ?? '' }}" required>
                </div>
            </div>

            <button class="btn btn-success float-end fw-bold" type="submit">
                @if (isset($customer))
                    Salvar
                @else
                    Cadastrar
                @endif

            </button>
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
