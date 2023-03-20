@extends('layouts.app')

@section('content')
    @if (isset($error))
        <div class="row text-center">
            <p class="text-danger">{{ $error }}</p>
        </div>
    @endif

    <div class="container">
        <div class="card">
            <div class="card-header bg-teal text-center">
                <span class="fw-bold pt-4 pb-4">
                    @if (isset($customer))
                        Editar dados do cliente
                    @else
                        Preencha os campos abaixo para cadastrar um novo cliente
                    @endif
                </span>
            </div>

            {{-- Form start --}}
            <div class="card-body">
                @if (isset($customer))
                    <form class="form-group needs-validation"
                        action="{{ route('customer.update', ['customer' => $customer->id]) }}" method="post" novalidate>
                        @method('put')
                    @else
                        <form class="form-group needs-validation" action="{{ route('customer.store') }}" method="post"
                            novalidate>
                @endif

                @csrf
                @if (isset($customer))
                    <div class="mb-3">

                        <label for="inputId" class="col-sm-2 col-form-label">ID do Cliente</label>
                        <input type="text" class="form-control" id="inputID" name="id" value="{{ $customer->id }}"
                            readonly>

                    </div>
                    <div class="mb-3 hidden">
                        <label for="user_id" class="col-sm-2 col-form-label">User_id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="user_id" name="user_id"
                                value="{{ $customer->user_id ?? Auth::User()->id }}" required readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="fw-bold form-label">Nome</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $customer->name ?? '' }}" required placeholder="Nome do cliente">
                            @error('name')
                                <span class="text-danger fs-6">{{ $errors->first('name') }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="fw-bold form-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $customer->email ?? '' }}" placeholder="emaildocliente@email.com">
                            @error('email')
                                <span class="text-danger fs-6">{{ $errors->first('email') }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="inputPhone" class="fw-bold form-label">Telefone</label>
                        <div class="col-sm-12">
                            <input type="phone" class="form-control" id="inputPhone" name="phone"
                                value="{{ $customer->phone ?? '' }}" required placeholder="67998880000">
                            @error('phone')
                                <span class="text-danger fs-6">{{ $errors->first('phone') }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="inputStreet" class="fw-bold form-label">Rua</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="inputStreet" name="street"
                                value="{{ $customer->street ?? '' }}" required placeholder="Av. Nove de Julho">
                            @error('street')
                                <span class="text-danger fs-6">{{ $errors->first('street') }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="inputNumber">Numero</label>
                        <div class="col-sm-2">
                            <input id="inputNumber" class="form-control" type="number" name="street_number"
                                value="{{ $customer->street_number ?? '' }}" required placeholder="1234">
                            @error('street_number')
                                <span class="text-danger fs-6">{{ $errors->first('street_number') }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="inputDistrict" class="fw-bold form-label">Bairro</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="inputDistrict" name="district"
                                value="{{ $customer->district ?? '' }}" required placeholder="Jardim Brasilândia">
                            @error('district')
                                <span class="text-danger fs-6">{{ $errors->first('district') }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="inputCity" class="fw-bold form-label">Cidade</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="inputCity" name="city"
                                value="{{ $customer->city ?? 'Fátima do Sul' }}" required placeholder="Fátima do Sul">
                            @error('city')
                                <span class="text-danger fs-6">{{ $errors->first('city') }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputState" class="fw-bold form-label">Estado</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control text-uppercase" id="inputState" name="state"
                                value="{{ $customer->state ?? 'MS' }}" required>
                            @error('state')
                                <span class="text-danger fs-6">{{ $errors->first('state') }}</span>
                            @enderror
                        </div>
                    </div>
                @else
                
                <div class="mb-3 hidden">
                    <label for="user_id" class="col-sm-2 col-form-label">User_id</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_id" name="user_id"
                            value="{{ Auth::User()->id }}" required readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="fw-bold form-label">Nome</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') ?? '' }}" required placeholder="Nome do cliente">
                        @error('name')
                            <span class="text-danger fs-6">{{ $errors->first('name') }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="fw-bold form-label">Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') ?? '' }}" placeholder="emaildocliente@email.com">
                        @error('email')
                            <span class="text-danger fs-6">{{ $errors->first('email') }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inputPhone" class="fw-bold form-label">Telefone</label>
                    <div class="col-sm-12">
                        <input type="phone" class="form-control" id="inputPhone" name="phone"
                            value="{{ old('phone') ?? '' }}" required placeholder="67998880000">
                        @error('phone')
                            <span class="text-danger fs-6">{{ $errors->first('phone') }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inputStreet" class="fw-bold form-label">Avenida / Rua</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputStreet" name="street"
                            value="{{ old('street') ?? '' }}" required placeholder="Nove de Julho">
                        @error('street')
                            <span class="text-danger fs-6">{{ $errors->first('street') }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="inputNumber">Número</label>
                    <div class="col-sm-2">
                        <input id="inputNumber" class="form-control" type="number" name="street_number"
                            value="{{ old('street_number') ?? '' }}" required placeholder="1234">
                        @error('street_number')
                            <span class="text-danger fs-6">{{ $errors->first('street_number') }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inputDistrict" class="fw-bold form-label">Bairro</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputDistrict" name="district"
                            value="{{ old('district') ?? '' }}" required placeholder="Jardim Brasilândia">
                        @error('district')
                            <span class="text-danger fs-6">{{ $errors->first('district') }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inputCity" class="fw-bold form-label">Cidade</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputCity" name="city"
                            value="{{ old('city') ?? 'Fátima do Sul' }}" required placeholder="Fátima do Sul">
                        @error('city')
                            <span class="text-danger fs-6">{{ $errors->first('city') }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputState" class="fw-bold form-label">Estado</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control text-uppercase" id="inputState" name="state"
                            value="{{ old('state') ?? 'MS' }}" required>
                        @error('state')
                            <span class="text-danger fs-6">{{ $errors->first('state') }}</span>
                        @enderror
                    </div>
                </div>
                @endif
                <div class="d-flex justify-content-end container mt-4 mb-2">
                    <button class="btn btn-success float-end me-2" type="submit">
                        @if (isset($customer))
                            Salvar
                        @else
                            Cadastrar
                        @endif

                    </button>

                    <a class="btn btn-secondary float-end me-2" href="{{ route('customer.index') }}">Voltar</a>
                </div>
                </form>
                {{-- form end --}}
            </div>
        </div>
    </div>
@endsection

{{-- 
                





 --}}
