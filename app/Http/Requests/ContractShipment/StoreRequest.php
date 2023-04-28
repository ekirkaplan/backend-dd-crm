<?php

namespace App\Http\Requests\ContractShipment;

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
            'exit_product_type_id' => ['required', 'int', 'exists:product_types,id'],
            'shipment_id' => ['required', 'int', 'exists:shipments,id'],
            'exit_city_id' => ['required', 'int', 'exists:cities,id'],
            'arrival_location_id' => ['required', 'int', 'exists:arrival_locations,id'],
            'exit_user_id' => ['required', 'int', 'exists:users,id'],
            'customer_id' => ['nullable'],
            'exit_licence_no' => ['nullable'],
            'exit_cubic_meter' => ['required'],
            'exit_date' => ['date', 'required'],
            'arrival_date' => ['date', 'required'],
            'arrival_tonnage' => ['required'],
            'shipment_invoice_no' => ['string', 'nullable'],
            'shipment_invoice_without_amount' => ['nullable'],
            'shipment_tax_rate' => ['integer', 'nullable'],
            'shipment_invoice_date' => ['date', 'nullable'],
            'shipment_invoice_total_amount' => ['nullable'],
            'shipment_invoice_withholding' => ['int', 'nullable'],
            'invoice_no' => ['string', 'nullable'],
            'tax_rate' => ['int', 'nullable'],
            'invoice_date' => ['date', 'nullable'],
            'invoice_without_amount' => ['nullable'],
            'invoice_total_amount' => ['nullable'],
            'invoice_withholding' => ['nullable'],
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
            'exit_date' => "Çıkış Tarihi",
            'shipment_invoice_no' => "Nakliye Fatura No",
            'shipment_tax_rate' => "Nakliye Fatura Vergi Oranı",
            'shipment_invoice_date' => "Nakliye Fatura Tarihi",
            'shipment_invoice_total_amount' => "Nakliye Fatura Genel Toplam",
            'shipment_invoice_withholding' => "Nakliye Fatura Tefkifat",
            'invoice_no' => "Fatura NO",
            'tax_rate' => "Fatura Vergi Oranı",
            'invoice_date' => "Fatura Tarihi",
            'invoice_without_amount' => "Fatura Vergi Hariç Fiyatı",
            'invoice_total_amount' => "Fatura Genel Toplam",
            'invoice_withholding' => "Fatura Tefkifat",
            'customer_id' => "Müşteri",
        ];
    }
}
