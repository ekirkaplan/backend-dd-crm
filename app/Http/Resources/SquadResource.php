<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SquadResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name
        ];
    }
}