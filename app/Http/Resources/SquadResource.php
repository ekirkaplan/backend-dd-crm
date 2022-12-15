<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SquadResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'foreman' => new EmployeeResource($this->foreman),
            'foreman_id' => $this->foreman_id,
            'employees' => EmployeeResource::collection($this->employees)
        ];
    }
}
