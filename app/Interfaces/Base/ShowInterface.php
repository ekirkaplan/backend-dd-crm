<?php

namespace App\Interfaces\Base;

use Illuminate\Database\Eloquent\Model;

interface ShowInterface
{
    /**
     * @param Model $model
     * @return Model
     */
    public function show(Model $model): Model;
}
