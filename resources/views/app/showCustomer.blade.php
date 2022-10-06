@extends('layouts.app')
@section('content')
    <div class="justify-content-center d-flex container">
        <div class="col-sm-6 mb-2">
            <div class="card border-success border">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">{{ $customer->name }}</h5>
                    <h6><b>ID: </b>{{ $customer->id }}</h6>
                    <p><b>Telefone: </b>{{ $customer->phone }}</p>
                    <p><b>Email: </b>{{ $customer->email }}</p>
                    <p><b>Endereço: </b>{{ $customer->address }}</p>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#notificationModal"
                        title="Envia notificação que irá prestar o serviço"><svg xmlns="http://www.w3.org/2000/svg"
                            width="30" height="30" fill="currentColor" class="bi bi-send me-2" viewBox="0 0 16 16">
                            <path
                                d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                        </svg>
                        Notificar
                    </button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#chargeModal"
                        title="Envia notificação de cobrança ao cliente"><svg xmlns="http://www.w3.org/2000/svg"
                            width="30" height="30" fill="currentColor" class="bi bi-cash me-2" viewBox="0 0 16 16">
                            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                            <path
                                d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z" />
                        </svg>
                        Cobrar
                    </button>


                </div>
            </div>

        </div>
    </div>
@endsection
