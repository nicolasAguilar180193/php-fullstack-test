<?php

namespace App\Repository\Region;

use Illuminate\Pagination\LengthAwarePaginator;

interface IRegionRepository
{
	public function list(): LengthAwarePaginator;
}