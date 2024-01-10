<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Repository\Region\IRegionRepository;

class RegionController extends Controller
{
    protected $regionRepository;

    public function __construct(IRegionRepository $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function index()
    {
        $regions = $this->regionRepository->list();

        return response()->json([
            'status' => true,
            'data' => [
                'regions' => $regions,
            ],
        ]);
    }
}
