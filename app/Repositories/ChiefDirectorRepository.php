<?php

namespace App\Repositories;

use App\Interfaces\ChiefDirectorInterface;
use App\Models\ChiefDirector;
use App\Models\RegionDirector;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class ChiefDirectorRepository implements ChiefDirectorInterface
{
    /**
     * @param  ChiefDirector  $chiefDirector
     */
    public function __construct(protected ChiefDirector $chiefDirector)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->chiefDirector
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->with('regionDirector')
            ->paginate($perPage);
    }

    /**
     * @param  RegionDirector  $regionDirector
     * @return Collection
     */
    public function getRegionOfChiefs(RegionDirector $regionDirector): Collection
    {
        return $this->chiefDirector->where('region_director_id', $regionDirector->id)->get();
    }
}
