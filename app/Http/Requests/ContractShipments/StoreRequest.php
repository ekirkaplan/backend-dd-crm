<?php

namespace App\Http\Requests\ContractShipments;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'contract_id' => ['required', 'int', 'exists:contracts,id'],
            'squad_id' => ['required', 'int', 'exists:squads,id'],
            'exit_product_type_id' => ['required', 'int', 'product_types,id'],
            'shipment_id' => ['required', 'int', 'exists:shipments,id'],
            'exit_city_id' => ['required', 'int', 'exists:cities,id'],
            'arrival_location_id' => ['required', 'int', 'exists:arrival_locations,id'],
            'exit_user_id' => ['required', 'int', 'exists:users,id'],
            'exit_licence_no' => ['required', 'string'],
            'exit_cubic_meter' => ['required'],
            'exit_date' => ['date', 'required']
        ];
    }

    public function attributes(): array
    {
        return [
            'contract_id' => 'Kesim Sözleşmesi',
            'squad_id' => "Kesim Ekibi",
            'exit_product_type_id' => "Ürün Tipi",
            'shipment_id' => "Sevkiyat",
            'exit_city_id' => "Çıkış Şehri",
            'arrival_location_id' => "Varış Lokasyonu",
            'exit_user_id' => "Çıkış Onaylayan",
            'exit_licence_no' => "Çıkış Lisans No",
            'exit_cubic_meter' => "Çıkış M3",
            'exit_date' => "Çıkış Tarihi"
        ];
    }
}
