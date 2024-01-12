<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Customer;
use App\Values\StatusValue;
use App\Repository\Customer\ICustomerRepository;
use App\Http\Resources\CustomerResource;

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

        $response_data = new CustomerResource($customers);

        return response()->json([
            'success' => true,
            'data' => $response_data->response()->getData(true),
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
