<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'type' => (integer)$this->type,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'address' => $this->address,
            'description' => $this->description,
            'type_string' => $this->type ? 'Usta Başı' : 'İşçi',
            'company' => new CompanyResource($this->company),
        ];
    }
}
