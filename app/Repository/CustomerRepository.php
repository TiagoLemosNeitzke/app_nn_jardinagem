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
        $customer = $this->customer->where('name', $request->name)->first();
        return view('app.showCustomer', ['customer' => $customer]);
    }
}
