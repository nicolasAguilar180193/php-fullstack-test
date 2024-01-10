<?php

namespace App\Repository\Customer;

use App\Models\Customer;
use App\Repository\Customer\ICustomerRepository;
use App\Values\StatusValue;
use Illuminate\Support\Facades\DB;

class CustomerRepository implements ICustomerRepository
{
	public function create(array $data): Customer
	{
		$customer = Customer::create([
            'dni' => $data['dni'],
            'id_reg' => $data['id_reg'],
            'id_com' => $data['id_com'],
            'email' => $data['email'],
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'] ?? null,
            'date_reg' => now(),
        ]);

		return $customer;
	}


	public function findByEmailorDni(?string $email, ?string $dni): ?Customer
	{
		$customer = Customer::with('region', 'commune')
			->where('status', StatusValue::ACTIVE->value)
			->where(function ($query) use ($email, $dni) {
				$query->where('email', $email)
					->orWhere('dni', $dni);
			})->first();
	
		return $customer;
	}

	public function logicalDeleteByEmail(string $email): bool
	{
		$result = DB::table('customers')
            ->where('email', $email)
            ->update(['status' => StatusValue::REMOVED->value]);
		
		return $result? true : false;
	}
}