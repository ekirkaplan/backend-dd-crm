<?php

namespace App\Services;

use App\Http\Resources\SquadResource;
use App\Models\Squad;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class SquadService
{
    /**
     * @param Squad $squad
     * @return SquadResource
     */
    public function setSingle(Squad $squad): SquadResource
    {
        return new SquadResource($squad);
    }

    /**
     * @param Collection $squads
     * @return JsonResource
     */
    public function setPlural(Collection $squads): JsonResource
    {
        return SquadResource::collection($squads);
    }
}
