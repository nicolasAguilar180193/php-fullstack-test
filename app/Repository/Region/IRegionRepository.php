<?php

namespace App\Repository\Region;

use App\Models\Region;
use Illuminate\Pagination\LengthAwarePaginator;

interface IRegionRepository
{
	public function list(): LengthAwarePaginator;
}