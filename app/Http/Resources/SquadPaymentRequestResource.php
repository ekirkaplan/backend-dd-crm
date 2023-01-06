<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SquadPaymentRequestResource extends JsonResource
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
            'squad_id' => $this->squad_id,
            'contract_id' => $this->contract_id,
            'payment_request_date' => $this->payment_request_date,
            'request_amount' => $this->request_amount,
            'description' => $this->description,
            'squad' => new SquadResource($this->squad),
            'contract' => new ContractResource($this->contract),
        ];
    }
}
