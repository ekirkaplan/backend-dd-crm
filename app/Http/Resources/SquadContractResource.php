<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadContractResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'squad_id' => $this->squad_id,
            'contract_id' => $this->contract_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'squad' => new SquadResource($this->squad),
            'contract' => new ContractResource($this->contract),

        ];
    }
}
