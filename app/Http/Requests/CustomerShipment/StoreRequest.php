<?php

namespace App\Http\Requests\CustomerShipment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'exit_type' => ['required', 'int'],
            'exit_model_id' => ['required', 'int'],
            'product_type_id' => ['required', 'int', 'exists:product_types,id'],
            'exit_city_id' => ['required', 'int', 'exists:cities,id'],
            'customer_id' => ['required', 'int', 'exists:customers,id'],
            'shipment_id' => ['required', 'int', 'exists:shipments,id'],
            'exit_company_id' => ['required', 'int', 'exists:companies,id'],
            'arrival_location_id' => ['required', 'int', 'exists:arrival_locations,id'],
            'supplier_purchase_invoice_no' => ['nullable'],
            'supplier_purchase_invoice_date' => ['nullable'],
            'supplier_purchase_invoice_amount' => ['nullable'],
            'shipment_date' => ['required'],
            'shipment_invoice_no' => ['nullable'],
            'shipment_invoice_date' => ['nullable'],
            'shipment_invoice_amount_without_tax' => ['nullable'],
            'shipment_invoice_total_amount' => ['nullable'],
            'shipment_tax_percentage' => ['nullable'],
            'shipment_invoice_withholding' => ['nullable'],
            'exit_tonnage' => ['required'],
            'different_shipping_amount_status' => ['required'],
            'arrival_tonnage' => ['required'],
            'different_tonnage_status' => ['required'],
            'product_invoice_no' => ['nullable'],
            'product_invoice_date' => ['nullable'],
            'product_invoice_amount_without_tax' => ['nullable'],
            'product_tax_percentage' => ['nullable'],
            'product_invoice_total_amount' => ['nullable'],
            'withholding' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return [
            'product_type_id' => 'Ürün Tipi',
            'exit_city_id' => 'Çıkış Şehir',
            'customer_id' => 'Müşteri',
            'shipment_id' => 'Sevkiyat',
            'exit_company_id' => 'Çıkış Firması',
            'supplier_purchase_invoice_no' => 'Tedarikçi satın alma fatura numarası',
            'supplier_purchase_invoice_date' => 'Tedarikçi satın alma fatura tarihi',
            'supplier_purchase_invoice_amount' => 'Tedarikçi satın alma fatura tutarı',
            'shipment_date' => 'Sevkiyat Tarihi',
            'shipment_invoice_amount' => 'sevkiyat Faturası Tutarı',
            'exit_tonnage' => 'Çıkış Tonajı',
            'different_shipping_amount_status' => 'Tonaj Farkı',
            'arrival_tonnage' => 'Varış Tonajı',
            'different_tonnage_status' => 'Tonaj Farkı Durumu',
            'product_invoice_no' => 'Ürün Fatura Numarası',
            'product_invoice_date' => 'Ürün Fatura Tarihi',
            'product_invoice_amount_without_tax' => 'Ürün Fatura Tutarı Vergi Hariç',
            'product_tax_percentage' => 'Ürün Vergi Oranı',
            'product_total_tax' => 'Ürün Toplam Vergi',
            'product_invoice_total_amount' => 'Ürün Toplam Vergi Tutarı',
            'withholding' => 'Tevkifat',
        ];
    }
}
