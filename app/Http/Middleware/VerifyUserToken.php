<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\TokenService;

class VerifyUserToken
{
    protected $tokenService;

	public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');

        if (!$this->tokenService->verificarToken($token)) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        return $next($request);
    }
}
