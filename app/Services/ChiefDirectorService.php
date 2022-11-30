<?php

namespace App\Services;

use App\Http\Resources\ChiefDirectorResource;
use App\Models\ChiefDirector;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class ChiefDirectorService
{
    /**
     * @param ChiefDirector $chiefDirector
     * @return ChiefDirectorResource
     */
    public function setSingle(ChiefDirector $chiefDirector): ChiefDirectorResource
    {
        return new ChiefDirectorResource($chiefDirector);
    }

    /**
     * @param Collection $chiefDirectors
     * @return JsonResource
     */
    public function setPlural(Collection $chiefDirectors): JsonResource
    {
        return ChiefDirectorResource::collection($chiefDirectors);
    }
}
