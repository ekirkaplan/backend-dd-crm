<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadEmplooyesResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->employee->id,
            'company_id' => $this->employee->company_id,
            'type' => (integer)$this->employee->type,
            'first_name' => $this->employee->first_name,
            'last_name' => $this->employee->last_name,
            'phone' => $this->employee->phone,
            'start_date' => $this->employee->start_date,
            'end_date' => $this->employee->end_date,
            'squad_start_date' => $this->start_date,
            'squad_end_date' => $this->end_date,
            'address' => $this->employee->address,
            'description' => $this->employee->description,
            'type_string' => $this->employee->type ? 'Usta Başı' : 'İşçi',
            'company' => new CompanyResource($this->employee->company),
        ];
    }
}
