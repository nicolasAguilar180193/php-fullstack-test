<?php

namespace App\Repository\Commune;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\Commune\ICommuneRepository;
use App\Models\Commune;

class CommuneRepository implements ICommuneRepository
{
	public function list(): LengthAwarePaginator
	{
		return Commune::paginate(5);
	}
}