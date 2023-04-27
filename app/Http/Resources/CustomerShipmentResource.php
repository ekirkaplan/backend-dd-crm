<?php

namespace App\Http\Resources;

use App\Models\ExitWarehouse;
use App\Models\Squad;
use App\Models\Supplier;
use Illuminate\Http\Resources\Json\JsonResource;
use function PHPUnit\Framework\isNull;

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
            'id' => $this->id,
            'product_type' => new ProductTypeResource($this->productType),
            'exit_city' => new CityResource($this->city),
            'customer' => new CustomerResource($this->customer),
            'shipment' => new ShipmentResource($this->shipment),
            'arrival_location' => new ArrivalLocationResource($this->arrivalLocation),
            'exit_company' => new CompanyResource($this->company),
            'exit_type' => $this->exitTypeConverter($this->exit_model_type),
            'exit_name' => isNull($this->exitType->name) ? $this->exitType->title : $this->exitType->name,
            'exit_model_id' => $this->exit_model_id,
            'product_type_id' => $this->product_type_id,
            'exit_city_id' => $this->exit_city_id,
            'arrival_location_id' => $this->arrival_location_id,
            'customer_id' => $this->customer_id,
            'shipment_id' => $this->shipment_id,
            'exit_company_id' => $this->exit_company_id,
            'supplier_purchase_invoice_no' => $this->supplier_purchase_invoice_no,
            'supplier_purchase_invoice_date' => $this->supplier_purchase_invoice_date,
            'supplier_purchase_invoice_amount' => $this->supplier_purchase_invoice_amount,
            'shipment_date' => $this->shipment_date,
            'shipment_invoice_amount' => $this->shipment_invoice_amount,
            'exit_tonnage' => $this->exit_tonnage,
            'different_shipping_amount_status' => $this->different_shipping_amount_status,
            'arrival_tonnage' => $this->arrival_tonnage,
            'different_tonnage_status' => $this->different_tonnage_status,
            'product_invoice_no' => $this->product_invoice_no,
            'product_invoice_date' => $this->product_invoice_date,
            'product_invoice_amount_without_tax' => $this->product_invoice_amount_without_tax,
            'product_tax_percentage' => $this->product_tax_percentage,
            'product_total_tax' => $this->product_total_tax,
            'product_invoice_total_amount' => $this->product_invoice_total_amount,
            'withholding' => $this->withholding,
            'shipment_invoice_no' => $this->shipment_invoice_no,
            'shipment_invoice_date' => $this->shipment_invoice_date,
            'shipment_invoice_amount_without_tax' => $this->shipment_invoice_amount_without_tax,
            'shipment_tax_percentage' => $this->shipment_tax_percentage,
            'shipment_invoice_total_amount' => $this->shipment_invoice_total_amount,
            'shipment_invoice_withholding' => $this->shipment_invoice_withholding,
        ];
    }

    private function exitTypeConverter(string $type): int
    {
        if ($type === "App\Models\ExitWarehouse") {
            return 0;
        } elseif ($type === "App\Models\Squad") {
            return 1;
        } elseif ($type === "App\Models\Supplier") {
            return 2;
        }
    }
}
