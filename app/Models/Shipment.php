<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use SoftDeletes, HasActivity;


    /**
     * @var string[]
     */
    protected $appends = ['vehicle_type_string'];
    /**
     * @var string
     */
    protected $table = 'shipments';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return Attribute
     */
    public function vehicleTypeString(): Attribute
    {
        if ($this->vehicle_type === 0) {
            $type_string = "TIR";
        } elseif ($this->vehicle_type === 1) {
            $type_string = "Kamyon";
        } elseif ($this->vehicle_type === 2) {
            $type_string = "Kırkayak";
        } elseif ($this->vehicle_type === 3) {
            $type_string = "Kamyonet";
        } else {
            $type_string = "Tanımsız !!!";
        }

        return new Attribute(
            get: fn() => $type_string,
        );
    }
}
