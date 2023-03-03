<?php

namespace App\Services;

use App\Http\Resources\ArrivalLocationResource;
use App\Http\Resources\CustomerShipmentResource;
use App\Models\ArrivalLocation;
use App\Repositories\CustomerShipmentReportRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerShipmentReportService
{
     public function setPlural(Collection $customerShipment): JsonResource
    {
        return CustomerShipmentResource::collection($customerShipment);
    }
}
