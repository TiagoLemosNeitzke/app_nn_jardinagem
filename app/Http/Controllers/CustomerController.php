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
        $customers = $this->customer->paginate(8);
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
        $request->validate($this->customer->rules(), $this->customer->feedback());
        if ($request->expiration_day >= 1 && $request->expiration_day <= 31) {
            $this->customer->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'type_service' => $request->type_service,
            'service_price' => $request->service_price,
            'is_monthly' => $request->is_monthly,
            'expiration_day' => $request->expiration_day
        ]);
            return redirect()->route('customer.index', ['message' => 'Cliente cadastrado com sucesso!']);
        } else {
            return view('app.formCustomer', ['errors' => 'Data de vencimento precisa estar entre os dias 1 e 31.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('app.showCustomer', ['customer' => $customer]);
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
        $request->validate($this->customer->rules(), $this->customer->feedback());
        if ($customer->expiration_day <=31 && $customer->expiration_day >= 1) {
            $this->customer->rules();
            $customer->update($request->all());
            return redirect()->route('customer.index', ['message' => 'Cadastrado atualizado com sucesso!']);
        } else {
            return view('app.formCustomer', ['error' => 'Erro ao salvar osa dados. Confira o preenchimento do fromulário e tente novamente']);
        }
        
        dd($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        dd('destroy');
    }
}
