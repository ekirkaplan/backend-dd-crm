<?php

namespace App\Interfaces\Base;

use Illuminate\Database\Eloquent\Model;

interface StoreInterface
{
    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;
}
