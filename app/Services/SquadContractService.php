<?php

namespace App\Services;

use App\Http\Resources\SquadContractResource;
use App\Models\SquadContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadContractService
{
    /**
     * @param SquadContract $squadContract
     * @return SquadContractResource
     */
    public function setSingle(SquadContract $squadContract): SquadContractResource
    {
        return new SquadContractResource($squadContract);
    }

    /**
     * @param Collection $squadContract
     * @return JsonResource
     */
    public function setPlural(Collection $squadContract): JsonResource
    {
        return SquadContractResource::collection($squadContract);
    }
}
