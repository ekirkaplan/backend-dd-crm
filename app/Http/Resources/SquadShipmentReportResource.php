<?php

namespace App\Http\Resources;

use App\Models\SquadContract;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadShipmentReportResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'contract' => new ContractResource($this->contract),
            'squad' => new SquadContract($this->squad),
            ''
        ];
    }
}
