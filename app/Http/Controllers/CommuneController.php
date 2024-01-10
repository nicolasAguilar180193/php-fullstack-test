<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commune;
use App\Repository\Commune\ICommuneRepository;

class CommuneController extends Controller
{
    protected $communeRepository;

    public function __construct(ICommuneRepository $communeRepository)
    {
        $this->communeRepository = $communeRepository;
    }
    
    public function index()
    {
        $communes = $this->communeRepository->list();

        return response()->json([
            'status' => true,
            'data' => $communes,
        ]);
    }
}
