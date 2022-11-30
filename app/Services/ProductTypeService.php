<?php

namespace App\Services;

use App\Http\Resources\ProductTypeResource;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeService
{
    /**
     * @param ProductType $productType
     * @return ProductTypeResource
     */
    public function setSingle(ProductType $productType): ProductTypeResource
    {
        return new ProductTypeResource($productType);
    }

    /**
     * @param Collection $productTypes
     * @return JsonResource
     */
    public function setPlural(Collection $productTypes): JsonResource
    {
        return ProductTypeResource::collection($productTypes);
    }
}
