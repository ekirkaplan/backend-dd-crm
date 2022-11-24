<?php

namespace App\Exceptions;

use App\Facades\JsonOutputFaced;
use Exception;
use Illuminate\Http\JsonResponse;

class PermissionExceptions extends Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return JsonOutputFaced::setStatusCode(403)->setMessage(__('permission.not_authorized'))->response();
    }
}
