<?php

namespace App\Repositories;

use App\Interfaces\ArrivalLocationInterface;
use App\Models\ArrivalLocation;
use Illuminate\Contracts\Pagination\Paginator;

class ArrivalLocationRepository implements ArrivalLocationInterface
{
    /**
     * @param  ArrivalLocation  $arrivalLocation
     */
    public function __construct(protected ArrivalLocation $arrivalLocation)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->arrivalLocation
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
                $query->orWhere('address', 'ilike', "%{$search}%");
            })
            ->with('city')
            ->paginate($perPage);
    }
}
