<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\TokenService;

class AuthController extends Controller
{
    protected $tokenService;

	public function __construct(TokenService $tokenService )
    {
        $this->tokenService = $tokenService;
    }

    public function login(UserLoginRequest $request)
	{
		$credentials = $request->only(['email', 'password']);
		if (Auth::attempt($credentials)) {
			$user = Auth::user();
			$token = $this->tokenService->generarToken($user->email);

			return response()->json([
                'status' => true,
				'data' => [
					'token' => $token,
				],
			]);
		}
		return response()->json([
            'status' => false,
            'errors' => [
                'message' => 'Invalid credentials'
            ],
        ], 401);
	}
}
