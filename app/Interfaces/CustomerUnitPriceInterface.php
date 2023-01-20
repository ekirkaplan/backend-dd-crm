<?php

namespace App\Interfaces;

use App\Models\City;
use App\Models\Customer;
use App\Models\CustomerUnitPrice;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Collection;

interface CustomerUnitPriceInterface extends FilteredInterface
{
    /**
     * @param  ProductType  $productType
     * @return CustomerUnitPrice
     */
    public function getForProductType(Customer $customer, ProductType $productType): CustomerUnitPrice;
}
