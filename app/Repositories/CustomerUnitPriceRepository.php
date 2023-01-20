<?php

namespace App\Repositories;

use App\Interfaces\CustomerUnitPriceInterface;
use App\Models\City;
use App\Models\Customer;
use App\Models\CustomerUnitPrice;
use App\Models\ProductType;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

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
            ->with('productType', 'customer')
            ->paginate($perPage);
    }

    public function getForProductType(Customer $customer, ProductType $productType): CustomerUnitPrice
    {
        return $this->customerUnitPrice->where('customer_id', $customer->id)
            ->where('product_type_id', $productType->id)
            ->first();
    }
}
