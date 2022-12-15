<?php

namespace App\Http\Resources;

use App\Repositories\ChiefDirectorRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
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
            'chief_director_id' => $this->chief_director_id,
            'region_director_id' => $this->region_director_id,
            'product_type_id' => $this->product_type_id,
            'exit_warehouse_id' => $this->exit_warehouse_id,
            'stack_no' => $this->stack_no,
            'parcel_no' => $this->parcel_no,
            'cubic_meter' => $this->cubic_meter,
            'contract_start_date' => $this->contract_start_date,
            'contract_end_date' => $this->contract_end_date,
            'forward_sale_price' => $this->forward_sale_price,
            'campaign_sale_price' => $this->campaign_sale_price,
            'contract_stamp_duty' => $this->contract_stamp_duty,
            'forward_invoice_fee' => $this->forward_invoice_fee,
            'contract_invoice_date' => $this->contract_invoice_date,
            'contract_receipt_no' => $this->contract_receipt_no,
            'field_pickup_date' => $this->field_pickup_date,
            'contract_invoice_price' => $this->contract_invoice_price,
            'actual_start_date' => $this->actual_start_date,
            'number_of_man_day' => $this->number_of_man_day,
            'extension_time_received' => $this->extension_time_received,
            'yield_percentage' => $this->yield_percentage,
            'chief_director' => new ChiefDirectorRepository($this->chiefDirector),
            'region_director' => new RegionDirectorResource($this->regionDirector),
            'product_type' => new ProductTypeResource($this->productType),
            'exit_warehouse' => new ExitWareHouseResource($this->exitWarehouse),
        ];
    }
}
