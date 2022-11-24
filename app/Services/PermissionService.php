<?php

namespace App\Services;

use App\Exceptions\PermissionExceptions;
use App\Facades\JsonOutputFaced;
use Illuminate\Http\JsonResponse;

class PermissionService
{
    /**
     * @param string $key
     * @return bool|PermissionExceptions|JsonResponse
     * @throws PermissionExceptions
     */
    public function permission(string $key): bool|PermissionExceptions|JsonResponse
    {
        if (is_null(auth()->user())) {
            return JsonOutputFaced::setStatusCode(401)->setMessage(__('auth.jwt.invalid_token'))->response();
        }

        if (auth()->user()->role()->first()) {
            $permissions = auth()->user()->role()->first()->permissions()->get()->pluck('name')->toArray();
            if (in_array($key, $permissions)) {
                return true;
            }
        }

        throw new PermissionExceptions();
    }
}
