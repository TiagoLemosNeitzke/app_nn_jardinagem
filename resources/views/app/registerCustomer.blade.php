@extends('layouts.app')

@section('registerCustomer')
    <div class="justify-content-center d-flex container mt-4">
        <div class="col-md-12 border-success mb-3">
            <div class="row text-center">
                <h5 class="bg-success text-light fw-bold pt-4 pb-4">Cadastrar Cliente</h5>
            </div>

            {{-- Form start --}}
            <form class="row g-3 needs-validation mt-4" action="{{ route('customer.store') }}" method="post" novalidate>
                @csrf
                <div class="row mb-3">
                    <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Telefone</label>
                    <div class="col-sm-10">
                        <input type="phone" class="form-control" id="inputPhone" name="phone" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Endereço</label>
                    <div class="col-sm-10">
                        <input type="phone" class="form-control" id="inputAddress" name="address" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Qual é o serviço?</legend>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Qual é o serviço?" required>
                            <option selected></option>
                            <option value="Jardinagem">Jardinagem</option>
                            <option value="Piscina">Piscina</option>
                            <option value="Jardinagem|Piscina">Jardinagem|Piscina</option>
                        </select>
                    </div>

                </div>

                <div class="row mb-3">
                    <label for="inputPrice" class="col-sm-2 col-form-label">Valor do serviço</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPrice" name="price" required>
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">É mensalidade?</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="gridRadios1" value="1" checked required
                                name="is_monthly">
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
                </fieldset>

                <button class="btn btn-success float-end fw-bold" type="submit">Cadastrar</button>
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
