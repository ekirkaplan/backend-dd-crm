<?php

namespace App\Services;

use App\Http\Resources\ContractCostResource;
use App\Http\Resources\DriverResource;
use App\Models\ContractCost;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractCostService
{
    /**
     * @param  Driver  $driver
     * @return DriverResource
     */
    public function setSingle(ContractCost $contractCost): ContractCostResource
    {
        return new ContractCostResource($contractCost);
    }

    /**
     * @param  Collection  $drivers
     * @return JsonResource
     */
    public function setPlural(Collection $contractCost): JsonResource
    {
        return ContractCostResource::collection($contractCost);
    }
}
