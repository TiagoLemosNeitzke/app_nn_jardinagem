<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = $this->customer->with('user')->orderBy('name', 'asc')->paginate(8);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = $this->customer->where('name', $request->get('name'))->first();
        
        if ($customer === null) {
            $this->customer->create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'street' => $request->street,
            'street_number' => $request->street_number,
            'district' => $request->district,
            'city' => $request->city,
            'state' => $request->state
        ]);
            return view('app.customers', ['message' => 'Cliente cadastrado com sucesso!']);
        }

        if ($customer->name === $request->get('name')) {
            return view('app.customers', ['error' => 'Cliente já possui cadastro! Verifique o cadastro de clientes. [001]']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer, Request $request)
    {
        $urlPrevious = url()->previous();
        $customer = $customer->where('id', $customer->id)->with('task')->first();
        //dd($customer);
        return view('app.showCustomer', ['customer' => $customer, 'user' => $request->get('user'), 'urlPrevious' => $urlPrevious]);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
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
        //$customer = $this->customer->destroy($customer->id);
        $customer = 0;
        if ($customer) {
            return redirect()->route('customer.index', ['message' => 'Cliente Removido com sucesso da nossa base de dados.']);
        } else {
            return view('app.customers', ['error' => 'Ocorreu um erro ao tentar remover os dados do cliente. Tente novamente ou entre em contato com o suporte. [002]']);
        }
    }
}
