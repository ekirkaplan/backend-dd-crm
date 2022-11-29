<?php

namespace App\Repositories;

use App\Interfaces\CustomerInterface;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\Paginator;

class CustomerRepository implements CustomerInterface
{
    /**
     * @param Customer $customer
     */
    public function __construct(protected Customer $customer)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->customer
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('title', 'ilike', "%{$search}%");
                $query->orWhere('phone', 'ilike', "%{$search}%");
                $query->orWhere('email', 'ilike', "%{$search}%");
                $query->orWhere('tax_number', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }

}
