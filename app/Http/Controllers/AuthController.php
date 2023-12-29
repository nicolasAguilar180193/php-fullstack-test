<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            echo $user->email;
			$token = $this->tokenService->generarToken($user->email);

			return response()->json([
				'data' => [
					'token' => $token,
				],
			]);
		}
		return response()->json(['errors' => ['message' => 'Invalid credentials']], 401);
	}
}
