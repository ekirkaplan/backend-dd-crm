<?php

namespace App\Http\Requests\Contracts;

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
            'chief_director_id' => ['required', 'integer', 'exists:chief_directors,id'],
            'region_director_id' => ['required', 'integer', 'exists:region_directors,id'],
            'product_type_id' => ['required', 'integer', 'exists:product_types,id'],
            'chiefdom_id' => ['required', 'integer', 'exists:chiefdoms,id'],
            'stack_no' => ['required', 'string', 'unique:contracts,stack_no'],
            'parcel_no' => ['required', 'string'],
            'cubic_meter' => ['required'],
            'contract_start_date' => ['required', 'date'],
            'contract_end_date' => ['required', 'date'],
            'forward_sale_price' => ['required'],
            'campaign_sale_price' => ['required'],
            'contract_stamp_duty' => ['required'],
            'contract_invoice_price' => ['required'],
            'forward_invoice_fee' => ['required'],
            'contract_invoice_date' => ['required', 'date'],
            'contract_receipt_no' => ['required', 'string'],
            'field_pickup_date' => ['required', 'date'],
            'actual_start_date' => ['required', 'date'],
            'number_of_man_day' => ['required', 'integer'],
            'extension_time_received' => ['required', 'integer'],
            'yield_percentage' => ['required', 'integer'],
            'files' => ['nullable', 'array'],
        ];
    }

    public function attributes(): array
    {
        return [
            'chief_director_id' => "Bölge İşletme Müdürlüğü",
            'region_director_id' => "Bölge Müdürlüğü",
            'product_type_id' => "Ürün Tipi",
            'stack_no' => "Sözleşme İstif No",
            'parcel_no' => "Parti NO",
            'cubic_meter' => "Metre Küp",
            'contract_start_date' => "Sözleşme Başlangıç Tarihi",
            'contract_end_date' => "Sözleşme Bittiş Tarihi",
            'forward_sale_price' => "Vadeli Satış Bedeli",
            'campaign_sale_price' => "Kampanyalı Satış Bedeli",
            'contract_stamp_duty' => "Sözleşme Damga Bedeli",
            'forward_invoice_fee' => "Vadeli Fatura Bedeli",
            'contract_invoice_date' => "Sözleşme Fatura Bedeli",
            'contract_receipt_no' => "Sözleşme Fiş NO",
            'field_pickup_date' => "Saha Teslim Tarihi",
            'actual_start_date' => "Fiili İşe Başlangıç Tarihi",
            'number_of_man_day' => "Adam Gün Sayısı",
            'extension_time_received' => "Alınan Uzatma Süresi",
            'yield_percentage' => "Verim Yüzdesi",
        ];
    }

}
