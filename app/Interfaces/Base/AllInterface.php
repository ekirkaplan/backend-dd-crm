<?php

namespace App\Interfaces\Base;

use Illuminate\Database\Eloquent\Collection;

interface AllInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;
}
