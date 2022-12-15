<?php

namespace App\Repositories;

use App\Interfaces\DriverInterface;
use App\Models\Driver;
use Illuminate\Contracts\Pagination\Paginator;

class DriverRepository implements DriverInterface
{
    /**
     * @param Driver $driver
     */
    public function __construct(protected Driver $driver)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->driver
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('first_name', 'ilike', "%{$search}%");
                $query->orWhere('last_name', 'ilike', "%{$search}%");
                $query->orWhere('phone', 'ilike', "%{$search}%");
            })->paginate($perPage);
    }
}
