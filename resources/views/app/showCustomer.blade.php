@extends('layouts.app')
@section('content')
    <div class="justify-content-center d-flex container">
        <div class="col-md-6 mb-2">
            <div class="card border-success">
                <div class="card-body">
                    @if (isset($user))
                        <p class="mb-4">Cliente foi cadastrado pelo usuário {{ $user }}</p>
                    @endif
                    <h5 class="card-title fw-bold mb-2">Nome: {{ $customer->name }}</h5>

                    <p class="fw-bold">Telefone: {{ $customer->phone }}</p>
                    <p class="fw-bold">Email: {{ $customer->email }}</p>
                    <p class="fw-bold">Endereço: {{ $customer->street }}, {{ $customer->street_number }}.
                        {{ $customer->district }}.
                        {{ $customer->city }} - {{ $customer->state }}.</p>

                    <div class="container">

                        <div class="row my-2">
                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#notificationModal" title="Envia notificação que irá prestar o serviço"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-send pb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                </svg>
                                Notificar
                            </button>
                        </div>


                        <div class="row">
                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#chargeModal" title="Envia notificação de cobrança ao cliente"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-cash pb-1" viewBox="0 0 16 16">
                                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                    <path
                                        d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z" />
                                </svg>
                                Cobrar
                            </button>
                        </div>

                        <div class="row my-2">
                            <a class="btn btn-outline-success btn-sm"
                                href="{{ route('task.create', ['id' => $customer->id, 'name' => $customer->name]) }}"
                                title="Realizar agendamento."><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                    height="25" fill="currentColor" class="bi bi-bookmark pb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                </svg>
                                Agendar
                            </a>
                        </div>

                        <div class="row">
                            <a class="btn btn-outline-primary btn-sm"
                                href="{{ route('customer.edit', ['customer' => $customer->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-pencil-square pb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>Editar</a>
                        </div>

                        <div class="row my-2">
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-trash3 pb-1" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>Apagar Registro</button>
                        </div>

                        <div class="row my-2">
                            <a class="btn btn-outline-secondary text-dark btn-sm" href="{{ $urlPrevious }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-skip-backward-circle pb-1" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M11.729 5.055a.5.5 0 0 0-.52.038L8.5 7.028V5.5a.5.5 0 0 0-.79-.407L5 7.028V5.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0V8.972l2.71 1.935a.5.5 0 0 0 .79-.407V8.972l2.71 1.935A.5.5 0 0 0 12 10.5v-5a.5.5 0 0 0-.271-.445z" />
                                </svg>
                                Voltar
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>


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
                                <label for="inputName" class="col-sm-12 col-form-label">Enviar notificação de
                                    serviço
                                    para:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="name"
                                        value="{{ $customer->name }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhone" class="col-sm-12 col-form-label">Telefone</label>
                                <div class="col-sm-10">
                                    <input type="phone" class="form-control" id="inputPhone" name="phone"
                                        value="{{ $customer->phone }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Mensagem</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message">Olá! {{ $customer->name }}, iremos prestar o serviço de {{ $customer->type_service }} hoje, dia {{ date('d-m') }}. Por favor confirme se terá alguém em sua residência.</textarea>
                            </div>

                        </form>
                        {{-- form end --}}
                    </div>
                    <div class="modal-footer bg-teal">
                        <a type="button" href="{{ route('customer.edit', ['customer' => $customer->id]) }}"
                            class="btn border-dark d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="30"
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
                                <label for="inputName" class="col-sm-12 col-form-label">Enviar notificação de
                                    cobrança
                                    para:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="name"
                                        value="{{ $customer->name }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhone" class="col-sm-12 col-form-label">Telefone</label>
                                <div class="col-sm-10">
                                    <input type="phone" class="form-control" id="inputPhone" name="phone"
                                        value="{{ $customer->phone }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Mensagem</label>
                                <textarea class="form-control" id="messageText" rows="3" name="message">Olá! {{ $customer->name }}, não identificamos o pagamento referente ao serviço {{ $customer->type_service }}, realizado no dia (implementar dia). Caso o pagamento tenha cido efetuado, por favor desconcidere esta mensagem.</textarea>
                            </div>

                        </form>
                        {{-- form end --}}
                    </div>
                    <div class="modal-footer bg-teal">
                        <button type="submit" href="" class="btn border-dark d-flex"
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

        <!-- Modal delete confirm-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-danger text-center">
                        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja excluir permanentemente os
                            dados do cliente?</h5>

                    </div>
                    <div class="modal-body text-center">
                        Os dados não poderão ser recuperados.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('customer.destroy', ['customer' => $customer->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- End modal delete confirm --}}
    </div>
@endsection
