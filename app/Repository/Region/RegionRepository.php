<?php

namespace App\Repository\Region;

use App\Models\Region;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\Region\IRegionRepository;

class RegionRepository implements IRegionRepository
{
	public function list(): LengthAwarePaginator
	{
		return Region::with('communes')->paginate(3);
	}
}