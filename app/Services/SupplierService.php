<?php

namespace App\Services;

use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierService
{
    /**
     * @param Supplier $supplier
     * @return SupplierResource
     */
    public function setSingle(Supplier $supplier): SupplierResource
    {
        return new SupplierResource($supplier);
    }

    /**
     * @param Collection $suppliers
     * @return JsonResource
     */
    public function setPlural(Collection $suppliers): JsonResource
    {
        return SupplierResource::collection($suppliers);
    }
}
