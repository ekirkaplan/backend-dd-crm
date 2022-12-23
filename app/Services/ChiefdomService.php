<?php

namespace App\Services;

use App\Http\Resources\ChiefdomResource;
use App\Models\Chiefdom;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ChiefdomService
{
    /**
     * @param Chiefdom $chiefdom
     * @return ChiefdomResource
     */
    public function setSingle(Chiefdom $chiefdom): ChiefdomResource
    {
        return new ChiefdomResource($chiefdom);
    }

    /**
     * @param Collection $chiefdom
     * @return JsonResource
     */
    public function setPlural(Collection $chiefdom): JsonResource
    {
        return ChiefdomResource::collection($chiefdom);
    }
}
