@extends('layouts.app')

@section('customer')
    <div class="container">
        <div class="row text-center">
            @if (isset($message))
                <p class="fw-bold fs-4 text-success">{{ $message }}</p>
            @endif
        </div>
        <div class="row">

            @if (isset($customers))
                @foreach ($customers as $customer)
                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-4">{{ $customer->name }}</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Ver Mais
                                </button>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Modal -->
        <div class="modal fade modal-dialog modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title fw-bold text-light" id="exampleModalLabel">Dados do cliente</h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Form start --}}
                        <form class="form-group needs-validation mt-4" action="" method="" novalidate>
                            @csrf
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="name"
                                        value="{{ $customer->name }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" name="email"
                                        value="{{ $customer->email }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPhone" class="col-sm-2 col-form-label">Telefone</label>
                                <div class="col-sm-10">
                                    <input type="phone" class="form-control" id="inputPhone" name="phone"
                                        value="{{ $customer->phone }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputAddress" class="col-sm-2 col-form-label">Endereço</label>
                                <div class="col-sm-10">
                                    <input type="phone" class="form-control" id="inputAddress" name="address"
                                        value="{{ $customer->address }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Qual é o serviço?</legend>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPrice" name="price"
                                        value="{{ $customer->type_service }}" readonly>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="inputPrice" class="col-sm-2 col-form-label">Valor do serviço</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPrice" name="price"
                                        value="{{ $customer->service_price }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPrice" class="col-sm-2 col-form-label">É mensalidade?</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPrice" name="price"
                                        value="{{ $customer->is_monthly ? 'Sim' : 'Não' }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPrice" class="col-sm-2 col-form-label">Mensaliade vence dia</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPrice" name="price"
                                        value="{{ $customer->expiration_day }}" readonly>
                                </div>
                            </div>

                        </form>
                        {{-- form end --}}
                    </div>
                    <div class="modal-footer bg-teal">
                        <a type="button" href="{{ route('customer.edit', ['customer' => $customer->id]) }}"
                            class="btn btn-success">Editar</a>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal-->
    </div>
@endsection
