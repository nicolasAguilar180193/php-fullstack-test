<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Customer;
use App\Values\StatusValue;

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

    public function show(Request $request)
    {
        $email = $request->query('email');
        $dni = $request->query('dni');
        $customers = Customer::with('region', 'commune')
            ->where('status', StatusValue::ACTIVE->value)
            ->where(function ($query) use ($email, $dni) {
                $query->where('email', $email)
                    ->orWhere('dni', $dni);
            })
            ->first();

        if (!$customers) {
            return response()->json([
                'success' => false,
                'error' => 'Customer not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $customers
        ]);
    }

}
