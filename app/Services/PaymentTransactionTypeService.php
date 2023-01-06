<?php

namespace App\Services;

use App\Http\Resources\ContractCostResource;
use App\Http\Resources\DriverResource;
use App\Http\Resources\PaymentTransactionTypeResource;
use App\Models\ContractCost;
use App\Models\Driver;
use App\Models\PaymentTransactionType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentTransactionTypeService
{
    /**
     * @param  Driver  $driver
     * @return DriverResource
     */
    public function setSingle(PaymentTransactionType $paymentTransactionType): PaymentTransactionTypeResource
    {
        return new PaymentTransactionTypeResource($paymentTransactionType);
    }

    /**
     * @param  Collection  $drivers
     * @return JsonResource
     */
    public function setPlural(Collection $paymentTransactionType): JsonResource
    {
        return PaymentTransactionTypeResource::collection($paymentTransactionType);
    }
}
