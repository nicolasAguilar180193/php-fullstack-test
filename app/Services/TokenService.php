<?php

namespace App\Services;

use App\Models\UserToken;

class TokenService
{
	protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function generarToken($email)
    {
        $token = sha1($email . now() . mt_rand(200, 500) . $this->apiKey);
        $userToken = UserToken::create([
            'token' => $token,
            'expires_at' => now()->addMinutes(30),
        ]);
        return $token;
    }

    public function verificarToken($token, $email)
    {
        $token = UserToken::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        $response = $token ? true : false;

        return $response;
    }
}