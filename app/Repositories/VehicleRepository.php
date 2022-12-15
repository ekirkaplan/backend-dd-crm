<?php

namespace App\Repositories;

use App\Interfaces\VehicleInterface;
use App\Models\Vehicle;
use Illuminate\Contracts\Pagination\Paginator;

class VehicleRepository implements VehicleInterface
{
    /**
     * @param Vehicle $vehicle
     */
    public function __construct(protected Vehicle $vehicle)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->vehicle
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
