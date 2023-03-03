<?php

namespace App\Http\Requests\CustomerShipment;

use Illuminate\Foundation\Http\FormRequest;

class BulkInvoiceUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_invoice_no' => ['required'],
            'product_invoice_date' => ['required'],
            'product_invoice_amount_without_tax' => ['required'],
            'product_tax_percentage' => ['required'],
            'product_invoice_total_amount' => ['required'],
            'withholding' => ['required'],
            'shipments' => ['array'],
        ];
    }

    public function authorize(): bool
    {
        return true;
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
            'withholding' => 'Stopaj',
        ];
    }
}
