<?php

namespace App\Repository\Customer;

use App\Models\Customer;

interface ICustomerRepository
{
	public function create(array $data): Customer;
	public function findByEmailorDni(?string $email, ?string $dni): ?Customer;
	public function delete(string $email): bool;
}