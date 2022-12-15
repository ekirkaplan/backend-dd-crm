<?php

namespace App\Interfaces;

use App\Models\RegionDirector;
use Illuminate\Database\Eloquent\Collection;

interface ChiefDirectorInterface extends FilteredInterface
{
    /**
     * @param  RegionDirector  $regionDirector
     * @return Collection
     */
    public function getRegionOfChiefs(RegionDirector $regionDirector): Collection;
}
