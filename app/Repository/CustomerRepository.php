<?php

namespace App\Repository;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerRepository
{
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getCustomerName(Request $request)
    {
        $parameters = '%'.$request->name.'%';
       
        $customer = $this->customer->where('name','like', $parameters)->first();
        return view('app.showCustomer', ['customer' => $customer]);
    }
}
