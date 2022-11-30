<?php

namespace App\Services;

use App\Http\Resources\RegionDirectorResource;
use App\Models\RegionDirector;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionDirectorService
{
    /**
     * @param RegionDirector $regionDirector
     * @return RegionDirectorResource
     */
    public function setSingle(RegionDirector $regionDirector): RegionDirectorResource
    {
        return new RegionDirectorResource($regionDirector);
    }

    /**
     * @param Collection $regionDirectors
     * @return JsonResource
     */
    public function setPlural(Collection $regionDirectors): JsonResource
    {
        return RegionDirectorResource::collection($regionDirectors);
    }
}
