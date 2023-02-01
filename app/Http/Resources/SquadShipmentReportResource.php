<?php

namespace App\Http\Resources;

use App\Models\ContractShipment;
use App\Models\SquadContract;
use App\Models\SquadPaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadShipmentReportResource extends JsonResource
{

    public string $a;

    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        return [
            'id' => $this->id,
            'contract' => new ContractResource($this->contract),
            'squad' => $this->squad,
            'totalShippedM3' => $this->calcTotalShippedM3($this->contract_id),
            'calcDateShippedM3' => $this->calcDateShippedM3($this->contract_id, $startDate, $endDate),
            'calcTotalSquadAmount' => $this->calcTotalSquadAmount($this->contract_id),
            'calcDateSquadAmount' => $this->calcDateSquadAmount($this->contract_id, $startDate, $endDate),
            'calcDateSquadPaymentRequest' => $this->calcDateSquadPaymentRequest($this->squad_id, $this->contract_id),

        ];
    }

    private function calcTotalShippedM3(int $contractId): int
    {
        return ContractShipment::where('contract_id', $contractId)->get('exit_cubic_meter')->sum('exit_cubic_meter');
    }

    private function calcDateShippedM3(int $contractId, string $startDate, string $endDate): int
    {
        return ContractShipment::where('contract_id', $contractId)
            ->whereBetween('exit_date', [$startDate, $endDate])
            ->get('exit_cubic_meter')
            ->sum('exit_cubic_meter');
    }

    private function calcTotalSquadAmount(int $contractId): int
    {
        return ContractShipment::where('contract_id', $contractId)->get('squad_calc_amount')->sum('squad_calc_amount');
    }

    private function calcDateSquadAmount(int $contractId, string $startDate, string $endDate): int
    {
        return ContractShipment::where('contract_id', $contractId)
            ->whereBetween('exit_date', [$startDate, $endDate])
            ->get('squad_calc_amount')
            ->sum('squad_calc_amount');
    }

    private function calcDateSquadPaymentRequest(int $squadId,int $contractId)
    {
        return SquadPaymentRequest::where('squad_id', $squadId)
            ->where('contract_id', $contractId)
            ->sum('request_amount');
    }


}
