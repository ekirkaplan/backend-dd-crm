<?php

namespace App\Repositories;

use App\Interfaces\CustomerUnitPriceInterface;
use App\Models\CustomerUnitPrice;
use Illuminate\Contracts\Pagination\Paginator;

class CustomerUnitPriceRepository implements CustomerUnitPriceInterface
{
    /**
     * @param CustomerUnitPrice $customerUnitPrice
     */
    public function __construct(protected CustomerUnitPrice $customerUnitPrice)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->customerUnitPrice
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('start_date', 'ilike', "%{$search}%");
                $query->orWhere('end_date', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
