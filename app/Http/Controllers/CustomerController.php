<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Customer;
use App\Values\StatusValue;
use App\Repository\Customer\ICustomerRepository;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function store(RegisterCustomerRequest $request)
    {
        $customer = $this->customerRepository->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $customer
        ]);
    }

    public function show(Request $request)
    {
        $email = $request->query('email');
        $dni = $request->query('dni');

        $customers = $this->customerRepository->findByEmailorDni($email, $dni);

        if (!$customers) {
            return response()->json([
                'success' => false,
                'error' => 'Customer does not exist.'
            ], 404);
        }

        $response_data = [
            'name' => $customers->name,
            'last_name' => $customers->last_name,
            'email' => $customers->email,
            'dni' => $customers->dni,
            'address' => $customers->address,
            'region' => $customers->region->description,
            'commune' => $customers->commune->description
        ];

        return response()->json([
            'success' => true,
            'data' => $response_data
        ]);
    }

    public function destroy(String $email)
    {
        $result = $this->customerRepository->delete($email);

        if(!$result) {
            return response()->json([
                'success' => false,
                'error' => 'Customer does not exist.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => 'Customer deleted successfully.'
        ]);
    }

}
