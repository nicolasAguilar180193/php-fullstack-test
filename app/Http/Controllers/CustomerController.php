<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(RegisterCustomerRequest $request)
    {
        $customer = Customer::create([
            'dni' => $request->dni,
            'id_reg' => $request->id_reg,
            'id_com' => $request->id_com,
            'email' => $request->email,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'date_reg' => now(),
        ]);

        return response()->json(['data' => $customer]);
    }
}
