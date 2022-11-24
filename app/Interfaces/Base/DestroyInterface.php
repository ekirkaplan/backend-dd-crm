<?php

namespace App\Interfaces\Base;

use Illuminate\Database\Eloquent\Model;

interface DestroyInterface
{
    /**
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool;
}
