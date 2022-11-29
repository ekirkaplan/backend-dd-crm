<?php

namespace App\Repositories;

use App\Interfaces\ProductTypeInterface;
use App\Models\ProductType;
use Illuminate\Contracts\Pagination\Paginator;

class ProductTypeRepository implements ProductTypeInterface
{
    /**
     * @param  ProductType  $productType
     */
    public function __construct(protected ProductType $productType)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->productType
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
