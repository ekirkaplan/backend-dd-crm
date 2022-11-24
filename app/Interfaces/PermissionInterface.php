<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface PermissionInterface
{
    /**
     * @param Model $model
     * @param array|null $data
     * @return void
     */
    public function sync(Model $model, ?array $data): void;

    /**
     * @param Model $model
     * @return void
     */
    public function detach(Model $model): void;
}
