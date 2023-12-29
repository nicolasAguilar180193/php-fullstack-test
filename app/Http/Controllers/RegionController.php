<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::with('communes')->get();

        return response()->json([
            'status' => true,
            'data' => [
                'regions' => $regions,
            ],
        ]);
    }
}
