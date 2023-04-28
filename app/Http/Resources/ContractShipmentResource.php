<?php

namespace App\Http\Resources;

use App\Models\Customer;
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
            'id' => $this->id,
            'exit_licence_no' => $this->exit_licence_no,
            'exit_cubic_meter' => $this->exit_cubic_meter,
            'exit_date' => $this->exit_date,
            'arrival_date' => $this->arrival_date,
            'contract_id' => $this->contract_id,
            'squad_id' => $this->squad_id,
            'customer_id' => $this->customer_id,
            'exit_product_type_id' => $this->exit_product_type_id,
            'shipment_id' => $this->shipment_id,
            'exit_city_id' => $this->exit_city_id,
            'arrival_location_id' => $this->arrival_location_id,
            'exit_user_id' => $this->exit_user_id,
            'arrival_tonnage' => $this->arrival_tonnage,
            'shipment_invoice_no' => $this->shipment_invoice_no,
            'shipment_tax_rate' => $this->shipment_tax_rate,
            'shipment_invoice_date' => $this->shipment_invoice_date,
            'shipment_invoice_total_amount' => $this->shipment_invoice_total_amount,
            'shipment_invoice_withholding' => $this->shipment_invoice_withholding,
            'invoice_no' => $this->invoice_no,
            'tax_rate' => $this->tax_rate,
            'invoice_date' => $this->invoice_date,
            'invoice_without_amount' => $this->invoice_without_amount,
            'invoice_total_amount' => $this->invoice_total_amount,
            'invoice_withholding' => $this->invoice_withholding,
            'contract' => new ContractResource($this->contract),
            'squad' => new SquadResource($this->squad),
            'exit_product_type' => new ProductTypeResource($this->productType),
            'shipment' => new ShipmentResource($this->shipment),
            'exit_city' => new CityResource($this->city),
            'arrival_location' => new ArrivalLocationResource($this->arrivalLocation),
            'exit_user' => new UserResource($this->user),
            'customer' =>  $this->customerResource($this->customer_id),
        ];
    }

    private function customerResource(int|null $customerId)
    {
        if ($customerId){
            return new CustomerResource(Customer::find($customerId));
        }else {
            return ['title' => "Tanımsız"];
        }
    }
}
