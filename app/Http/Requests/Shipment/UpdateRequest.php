<?php

namespace App\Http\Requests\Shipment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'driver_name' => ['required', 'string'],
            'driver_phone' => ['required', 'string'],
            'vehicle_plate' => ['required', 'string'],
            'vehicle_brand' => ['nullable', 'string'],
            'vehicle_type' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'driver_name' => "Sürücü Adı",
            'driver_phone' => "Sürücü Telefon Numarası",
            'vehicle_plate' => "Araç Plakası",
            'vehicle_brand' => "Araç Model Marka",
            'vehicle_type' => "Araç Tipi",
            'description' => "Açıklama",
        ];
    }
}
