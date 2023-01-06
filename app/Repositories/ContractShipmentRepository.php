<?php

namespace App\Repositories;

use App\Interfaces\ContractShipmentInterface;
use App\Models\ContractShipment;
use Illuminate\Contracts\Pagination\Paginator;

class ContractShipmentRepository implements ContractShipmentInterface
{
    /**
     * @param ContractShipment $contractShipment
     */
    public function __construct(protected ContractShipment $contractShipment)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->contractShipment
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('exit_licence_no', 'ilike', "%{$search}%");
                $query->orWhere('exit_date', 'ilike', "%{$search}%");
            })
            ->with(['company'])
            ->orderBy('id')
            ->paginate($perPage);
    }
}
