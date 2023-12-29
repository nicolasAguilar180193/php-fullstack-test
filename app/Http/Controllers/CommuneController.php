<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commune;

class CommuneController extends Controller
{
    public function index()
    {
        $communes = Commune::all();

        return response()->json([
            'status' => true,
            'data' => [
                'communes' => $communes,
            ],
        ]);
    }
}
