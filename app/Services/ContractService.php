<?php

namespace App\Services;

use App\Http\Resources\ChiefDirectorResource;
use App\Http\Resources\ContractResource;
use App\Models\ChiefDirector;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractService
{
    /**
     * @param  Contract  $contract
     * @return ContractResource
     */
    public function setSingle(Contract $contract): ContractResource
    {
        return new ContractResource($contract);
    }

    /**
     * @param Collection $contract
     * @return JsonResource
     */
    public function setPlural(Collection $contract): JsonResource
    {
        return ContractResource::collection($contract);
    }
}
