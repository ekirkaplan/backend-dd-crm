<?php

namespace App\Interfaces;

use App\Models\ChiefDirector;
use Illuminate\Database\Eloquent\Collection;

interface ChiefdomInterface extends FilteredInterface
{
    /**
     * @param  ChiefDirector  $chiefDirector
     * @return Collection
     */
    public function getByChiefDirector(ChiefDirector $chiefDirector): Collection;

}
