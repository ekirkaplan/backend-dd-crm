<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractShipmentResource extends JsonResource
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
            'contract' => new ContractResource($this->contract),
            'squad' => new SquadResource($this->squad),
            'exit_product_type' => new ProductTypeResource($this->productType),
            'shipment' => new ShipmentResource($this->shipment),
            'exit_city' => new CityResource($this->city),
            'arrival_location' => new ArrivalLocationResource($this->arrivalLocation),
            'exit_user' => new UserResource($this->user),
            'exit_licence_no' => 'exit_licence_no',
            'exit_cubic_meter' => 'exit_cubic_meter',
            'exit_date' => 'exit_date'
        ];
    }
}
