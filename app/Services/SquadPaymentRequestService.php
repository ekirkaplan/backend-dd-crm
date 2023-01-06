<?php

namespace App\Services;

use App\Http\Resources\CountryResource;
use App\Http\Resources\SquadPaymentRequestResource;
use App\Models\Country;
use App\Models\SquadPaymentRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadPaymentRequestService
{
    /**
     * @param SquadPaymentRequest $squadPaymentRequest
     * @return SquadPaymentRequestResource
     */
    public function setSingle(SquadPaymentRequest $squadPaymentRequest): SquadPaymentRequestResource
    {
        return new SquadPaymentRequestResource($squadPaymentRequest);
    }

    /**
     * @param Collection $squadPaymentRequest
     * @return JsonResource
     */
    public function setPlural(Collection $squadPaymentRequest): JsonResource
    {
        return SquadPaymentRequestResource::collection($squadPaymentRequest);
    }
}
