<?php

namespace App\Services;

use App\Http\Resources\ArrivalLocationResource;
use App\Http\Resources\SquadPaymentTransactionResource;
use App\Models\ArrivalLocation;
use App\Models\SquadPaymentTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadPaymentTransactionService
{
    /**
     * @param ArrivalLocation $arrivalLocation
     * @return ArrivalLocationResource
     */
    public function setSingle(SquadPaymentTransaction $squadPaymentTransaction): SquadPaymentTransactionResource
    {
        return new SquadPaymentTransactionResource($squadPaymentTransaction);
    }

    /**
     * @param Collection $arrivalLocations
     * @return JsonResource
     */
    public function setPlural(Collection $squadPaymentTransaction): JsonResource
    {
        return SquadPaymentTransactionResource::collection($squadPaymentTransaction);
    }
}
