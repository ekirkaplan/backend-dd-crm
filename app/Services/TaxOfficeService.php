<?php

namespace App\Services;

use App\Http\Resources\TaxOfficeResource;
use App\Models\TaxOffice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxOfficeService
{
    /**
     * @param  TaxOffice  $taxOffice
     * @return TaxOfficeResource
     */
    public function setSingle(TaxOffice $taxOffice): TaxOfficeResource
    {
        return new TaxOfficeResource($taxOffice);
    }

    /**
     * @param  Collection  $taxOffice
     * @return JsonResource
     */
    public function setPlural(Collection $taxOffice): JsonResource
    {
        return TaxOfficeResource::collection($taxOffice);
    }
}
