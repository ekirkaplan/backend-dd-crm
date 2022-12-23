<?php

namespace App\Repositories;

use App\Interfaces\SquadUnitPriceInterface;
use App\Models\SquadUnitPrice;
use Illuminate\Contracts\Pagination\Paginator;

class SquadUnitPriceRepository implements SquadUnitPriceInterface
{
    /**
     * @param SquadUnitPrice $squadUnitPrice
     */
    public function __construct(protected SquadUnitPrice $squadUnitPrice)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->squadUnitPrice
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('start_date', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
