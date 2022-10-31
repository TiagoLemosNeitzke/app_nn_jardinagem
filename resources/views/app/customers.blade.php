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
                {{-- {{ $customers->links() }} --}}
                @foreach ($customers as $customer)
                    <div class="col-sm-6 mb-2">
                        <div class="card border-success border">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-4">{{ $customer->name }}</h5>
                                <h6><b>ID: </b>{{ $customer->id }}</h6 <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#customerModal" title="Ver mais dados do cliente"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-person me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                    Ver Mais
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#notificationModal"
                                    title="Envia notificação que irá prestar o serviço"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-send me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                    </svg>
                                    Notificar
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#chargeModal" title="Envia notificação de cobrança ao cliente"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-cash me-2" viewBox="0 0 16 16">
                                        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                        <path
                                            d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z" />
                                    </svg>
                                    Cobrar
                                </button>
                                <a href="{{ route('plan.create', ['id' => $customer->id, 'name' => $customer->name]) }}"
                                    class="btn btn-success mt-2" title="Realizar agendamento."><svg
                                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-bookmark" viewBox="0 0 16 16">
                                        <path
                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                    </svg>
                                    Agendar
                                </a>

                            </div>
                        </div>

                    </div>
                @endforeach
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link bg-teal text-light" href="{{ $customers->previousPageUrl() }}"
                                    aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $customers->lastPage(); $i++)
                                <li class="page-item {{ $customers->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link bg-teal text-light"
                                        href="{{ $customers->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item">
                                <a class="page-link bg-teal text-light" href="{{ $customers->nextPageUrl() }}"
                                    aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
            @endif
        </div>
    </div>
    @if (isset($customer))
        <!-- Modal -->
        <div class="modal fade modal-lg" id="customerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            class="btn btn-success d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                height="30" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>Editar</a>

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><svg
                                xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-trash3 me-2" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>Excluir</button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><svg
                                xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-x-circle me-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal-->

        <!-- Modal notification-->
        <div class="modal fade modal-lg" id="notificationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title fw-bold text-light" id="exampleModalLabel">Notificar Cliente</h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Form start --}}
                        <form class="form-group needs-validation mt-4" action="" method="" novalidate>
                            @csrf
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-12 col-form-label"><b>Enviar notificação de serviço
                                        para:</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="name"
                                        value="{{ $customer->name }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhone" class="col-sm-12 col-form-label"><b>Telefone</b></label>
                                <div class="col-sm-10">
                                    <input type="phone" class="form-control" id="inputPhone" name="phone"
                                        value="{{ $customer->phone }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Mensagem</b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message">Olá! {{ $customer->name }}, iremos prestar o serviço de {{ $customer->type_service }} hoje, dia {{ date('d-m') }}. Por favor confirme se terá alguém em sua residência.</textarea>
                            </div>

                        </form>
                        {{-- form end --}}
                    </div>
                    <div class="modal-footer bg-teal">
                        <a type="button" href="{{ route('customer.edit', ['customer' => $customer->id]) }}"
                            class="btn btn-success d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                height="30" fill="currentColor" class="bi bi-send-check me-2" viewBox="0 0 16 16">
                                <path
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372l2.8-7Zm-2.54 1.183L5.93 9.363 1.591 6.602l11.833-4.733Z" />
                                <path
                                    d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
                            </svg>Enviar Notificação</a>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><svg
                                xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-x-circle me-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal-->

        <!-- Modal notification charge-->
        <div class="modal fade modal-lg" id="chargeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title fw-bold text-light" id="exampleModalLabel">Cobrar Cliente</h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Form start --}}
                        <form class="form-group needs-validation mt-4" action="" method="" novalidate>
                            @csrf
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-12 col-form-label"><b>Enviar notificação de cobrança
                                        para:</b></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="name"
                                        value="{{ $customer->name }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhone" class="col-sm-12 col-form-label"><b>Telefone</b></label>
                                <div class="col-sm-10">
                                    <input type="phone" class="form-control" id="inputPhone" name="phone"
                                        value="{{ $customer->phone }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label"><b>Mensagem</b></label>
                                <textarea class="form-control" id="messageText" rows="3" name="message">Olá! {{ $customer->name }}, não identificamos o pagamento referente ao serviço {{ $customer->type_service }}, realizado no dia (implementar dia). Caso o pagamento tenha cido efetuado, por favor desconcidere esta mensagem.</textarea>
                            </div>

                        </form>
                        {{-- form end --}}
                    </div>
                    <div class="modal-footer bg-teal">
                        <button type="submit" href="" class="btn btn-success d-flex"
                            onclick="sendMessagemWhatsapp()"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                height="30" fill="currentColor" class="bi bi-send-check me-2" viewBox="0 0 16 16">
                                <path
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372l2.8-7Zm-2.54 1.183L5.93 9.363 1.591 6.602l11.833-4.733Z" />
                                <path
                                    d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
                            </svg>Enviar Cobrança</button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><svg
                                xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-x-circle me-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal-->
    @endif
    </div>
@endsection
