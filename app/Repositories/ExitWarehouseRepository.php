<?php

namespace App\Repositories;

use App\Interfaces\ExitWarehouseInterface;
use App\Models\ExitWarehouse;
use Illuminate\Contracts\Pagination\Paginator;

class ExitWarehouseRepository implements ExitWarehouseInterface
{
    /**
     * @param ExitWarehouse $exitWarehouses
     */
    public function __construct(protected ExitWarehouse $exitWarehouses)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->exitWarehouses
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
                $query->orWhere('address', 'ilike', "%{$search}%");
                $query->orWhere('phone', 'ilike', "%{$search}%");
            })
            ->with('city')
            ->paginate($perPage);
    }
}
