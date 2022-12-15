<?php

namespace App\Repositories;

use App\Interfaces\CityInterface;
use App\Models\City;
use App\Models\Country;
use Illuminate\Contracts\Pagination\Paginator;

class CityRepository implements CityInterface
{
    /**
     * @param  City  $city
     */
    public function __construct(protected City $city)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->city
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
