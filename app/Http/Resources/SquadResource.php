<?php

namespace App\Http\Resources;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'foreman' => new EmployeeResource($this->foreman),
            'foreman_id' => $this->foreman_id,
            'name' => $this->foreman->first_name . ' ' . $this->foreman->last_name,
            'employees' => SquadEmplooyesResource::collection($this->squadEmployees),
            'contracts' => ContractResource::collection($this->getContracts())
        ];
    }

    private function getContracts(): Collection
    {
        $contractIds = $this->contracts()->pluck('contract_id');

        return Contract::whereIn('id', $contractIds)->get();
    }
}
