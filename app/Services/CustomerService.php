<?php

namespace App\Services;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerService
{
    /**
     * @param Customer $customer
     * @return CustomerResource
     */
    public function setSingle(Customer $customer): CustomerResource
    {
        return new CustomerResource($customer);
    }

    /**
     * @param Collection $customers
     * @return JsonResource
     */
    public function setPlural(Collection $customers): JsonResource
    {
        return CustomerResource::collection($customers);
    }
}
