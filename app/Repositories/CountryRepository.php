<?php

namespace App\Repositories;

use App\Interfaces\CountryInterface;
use App\Models\Country;
use Illuminate\Contracts\Pagination\Paginator;

class CountryRepository implements CountryInterface
{
    /**
     * @param Country $country
     */
    public function __construct(protected Country $country)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->country
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
                $query->orWhere('native_name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
