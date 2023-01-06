<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerShipmentResource extends JsonResource
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
            'product_type' => new ProductTypeResource($this->productType),
            'exit_city' => new CityResource($this->city),
            'customer' => new CustomerResource($this->customer),
            'shipment' => new ShipmentResource($this->shipment),
            'exit_company' => new CompanyResource($this->company),
            'supplier_purchase_invoice_no' => 'supplier_purchase_invoice_no',
            'supplier_purchase_invoice_date' => 'supplier_purchase_invoice_date',
            'supplier_purchase_invoice_amount' => 'supplier_purchase_invoice_amount',
            'shipment_date' => 'shipment_date',
            'exit_tonnage' => 'exit_tonnage',
            'different_shipping_amount_status' => 'different_shipping_amount_status',
            'arrival_tonnage' => 'arrival_tonnage',
            'different_tonnage_status' => 'different_tonnage_status',
            'product_invoice_no' => 'product_invoice_no',
            'product_invoice_date' => 'product_invoice_date',
            'product_invoice_amount_without_tax' => 'product_invoice_amount_without_tax',
            'product_tax_percentage' => 'product_tax_percentage',
            'product_total_tax' => 'product_total_tax',
            'product_invoice_total_amount' => 'product_invoice_total_amount',
            'withholding' => 'withholding'
        ];
    }
}
