<?php

namespace App\Repository;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerRepository
{
    public function getCustomerName(Request $request)
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
}
