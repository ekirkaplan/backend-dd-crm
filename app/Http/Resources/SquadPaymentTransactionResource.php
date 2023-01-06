<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SquadPaymentTransactionResource extends JsonResource
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
            'payment_transaction_type_id' => $this->payment_transaction_type_id,
            'contact_id' => $this->contact_id,
            'squad_id' => $this->squad_id,
            'total_transaction_amount' => $this->total_transaction_amount,
            'total_payment_amount' => $this->total_payment_amount,
            'payment_date' => $this->payment_date,
            'payment_amount' => $this->payment_amount,
            'description' => $this->description,
            'payment_transaction_type' => new PaymentTransactionTypeResource($this->paymentTransactionType),
            'contact' => new ContractResource($this->contact),
            'squad' => new SquadResource($this->squad),
        ];
    }
}
