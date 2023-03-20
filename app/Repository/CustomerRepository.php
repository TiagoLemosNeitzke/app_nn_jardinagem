<?php

namespace App\Repository;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUpdateCustomerFormRequest;
use Illuminate\Support\Facades\Validator;

class CustomerRepository
{
    public function customerSearch(Request $request)
    {
        $params = '%'.$request->name.'%';
        $url = url()->previous();
        $customers = Customer::where('name', 'like', $params)->paginate(4);
        if ($customers->total() == 0) {
            return view('app.customers', ['customers' => $customers, 'url' => $url, 'error' => 'Sua busca não retornou nenhum cliente.']);
        } else {
            return view('app.customers', ['customers' => $customers, 'url' => $url, 'returnSearch' => 'Sua busca retornou o(s) seguinte(s) cliente(s).']);
        }
    }

    public function getCustomers()
    {
        $customers = Customer::where('user_id', auth()->user()->id)->with('user')->orderBy('name', 'asc')->paginate(8);

        return $customers;
    }

    public function getCustomerName($request)
    {
        $customer = Customer::where('name', $request['name'])->first();
        
        return $customer;
    }

    public function getCustomerId($customer)
    {
        $customer = Customer::where('id', $customer->id)->with('user', 'task')->first();

        return $customer;
    }
}
