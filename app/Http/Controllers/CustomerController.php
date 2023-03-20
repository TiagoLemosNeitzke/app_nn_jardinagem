<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateCustomerFormRequest;
use App\Models\Customer;
use App\Repository\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(public Customer $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CustomerRepository $customers)
    {
        $customers = $customers->getCustomers();
        
        if ($request->message) {
            return view('app.customers', ['customers' => $customers, 'message' => $request->message]);
        } else {
            return view('app.customers', ['customers' => $customers]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.formCustomer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateUpdateCustomerFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUpdateCustomerFormRequest $request, CustomerRepository $customer)
    {
        $customer = $customer->getCustomerName($request->validated());
        
        if ($customer === null) {
            $customer = $this->customer->create($request->validated());
            if ($customer->exists()) {
                return view('app.customers', ['message' => 'Cliente cadastrado com sucesso!']);
            } else {
                return view('app.customers', ['error' => 'Cliente não pode ser cadastrado. Tente novamente ou entre em contato com o suporte.[011]']);
            }
        }

        if ($customer->name === $request->validated('name')) {
            return view('app.customers', ['error' => 'Cliente já possui cadastro! Verifique o cadastro de clientes. [001]']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer, CustomerRepository $customerFiltered)
    {
        $urlPrevious = url()->previous();

        $customer = $customerFiltered->getCustomerId($customer);
        
        return view('app.showCustomer', ['customer' => $customer, 'user' => $customer->user->name, 'urlPrevious' => $urlPrevious]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('app.formCustomer', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CreateUpdateCustomerFormRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUpdateCustomerFormRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return redirect()->route('customer.index', ['message' => 'Cadastrado atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer = $customer->destroy($customer->id);
        if ($customer) {
            return redirect()->route('customer.index', ['message' => 'Cliente Removido com sucesso da nossa base de dados.']);
        } else {
            return view('app.customers', ['error' => 'Ocorreu um erro ao tentar remover os dados do cliente. Tente novamente ou entre em contato com o suporte. [002]']);
        }
    }
}
