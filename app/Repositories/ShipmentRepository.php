<?php

namespace App\Repositories;

use App\Interfaces\ShipmentInterface;
use App\Models\Shipment;
use Illuminate\Contracts\Pagination\Paginator;

class ShipmentRepository implements ShipmentInterface
{
    /**
     * @param Shipment $shipment
     */
    public function __construct(protected Shipment $shipment)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->shipment
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('driver_name', 'ilike', "%{$search}%");
                $query->orWhere('driver_phone', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
