<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractCostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'contract_id' => $this->contract_id,
            'cost_type_id' => $this->cost_type_id,
            'squad_id' => $this->squad_id,
            'cost_amount' => $this->cost_amount,
            'cost_date' => $this->cost_date,
            'description' => $this->description,
            'contract' => new ContractResource($this->contract),
            'cost_type' => new CostTypeResource($this->costType),
            'squad' => new SquadResource($this->squad),
        ];
    }
}
