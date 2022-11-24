<?php

namespace App\Interfaces\Base;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UpdateInterface
{
    /**
     * @param Model $mode
     * @param array $data
     * @return User
     */
    public function update(Model $mode, array $data): Model;
}
