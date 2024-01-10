<?php

namespace App\Repository\Commune;

use Illuminate\Pagination\LengthAwarePaginator;

interface ICommuneRepository
{
	public function list(): LengthAwarePaginator;
}