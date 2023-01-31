<?php

namespace App\Http\Resources;

use App\Models\ContractCost;
use App\Models\ContractShipment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractReportResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'contract' => new ContractResource($this),
            'totalShippedM3' => $this->calcTotalShippedM3($this->id),
            'totalSquadAmount' => $this->calcTotalSquadAmount($this->id),
            'totalCost' => $this->calcTotalCost($this->id),
            'remainingCubicMeters' => $this->cubic_meter - $this->calcTotalShippedM3($this->id),
        ];
    }

    private function calcTotalShippedM3(int $contractId): int
    {
        return ContractShipment::where('contract_id', $contractId)->get('exit_cubic_meter')->sum('exit_cubic_meter');
    }

    private function calcTotalSquadAmount(int $contractId): int
    {
        return ContractShipment::where('contract_id', $contractId)->get('squad_calc_amount')->sum('squad_calc_amount');
    }

    private function calcTotalCost(int $contractId): float
    {
        return ContractCost::where('contract_id', $contractId)->sum('cost_amount');
    }
}
