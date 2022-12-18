<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'driver_name' => $this->driver_name,
            'driver_phone' => $this->driver_phone,
            'vehicle_plate' => $this->vehicle_plate,
            'vehicle_brand' => $this->vehicle_brand,
            'vehicle_type' => $this->vehicle_type,
            'vehicle_type_string' => $this->vehicle_type_string,
            'description' => $this->description,
        ];
    }
}
