<?php

namespace App\Repositories;

use App\Interfaces\RegionDirectoreInterface;
use App\Models\RegionDirectore;
use Illuminate\Contracts\Pagination\Paginator;

class RegionDirectoreRepository implements RegionDirectoreInterface
{
    /**
     * @param RegionDirectore $regionDirectore
     */
    public function __construct(protected RegionDirectore $regionDirectore)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->regionDirectore
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
