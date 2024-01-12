<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commune;
use App\Repository\Commune\ICommuneRepository;
use App\Http\Resources\CommuneResource;

class CommuneController extends Controller
{
    protected $communeRepository;

    public function __construct(ICommuneRepository $communeRepository)
    {
        $this->communeRepository = $communeRepository;
    }
    
    public function index()
    {
        $communes = CommuneResource::collection($this->communeRepository->list());

        return response()->json([
            'status' => true,
            'data' => $communes->response()->getData(true),
        ]);
    }
}
