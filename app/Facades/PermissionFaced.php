<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self permission(string $key)
 * @see \App\Services\PermissionService
 */
class PermissionFaced extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'permission_service';
    }
}
