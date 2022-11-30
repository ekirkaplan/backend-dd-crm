<?php

namespace App\Repositories;

use App\Interfaces\RegionDirectorInterface;
use App\Models\RegionDirector;
use Illuminate\Contracts\Pagination\Paginator;

class RegionDirectorRepository implements RegionDirectorInterface
{
    /**
     * @param RegionDirector $regionDirector
     */
    public function __construct(protected RegionDirector $regionDirector)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->regionDirector
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
