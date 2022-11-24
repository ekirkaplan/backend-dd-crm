<?php

namespace App\Services;

use App\Facades\JsonOutputFaced;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationService
{
    /**
     * @param string $token
     * @return array
     */
    public function createNewToken(string $token): array
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => Auth::user(),
        ];

        return $data;
    }

    /**
     * @param string $token
     * @return JsonResponse
     */
    public function refreshToken(string $token): JsonResponse
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];

        return JsonOutputFaced::setData($data)->response();
    }
}
