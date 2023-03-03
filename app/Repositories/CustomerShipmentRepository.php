<?php

namespace App\Repositories;

use App\Interfaces\CustomerShipmentInterface;
use App\Models\CustomerShipment;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class CustomerShipmentRepository implements CustomerShipmentInterface
{
    /**
     * @param  CustomerShipment  $customerShipment
     */
    public function __construct(protected CustomerShipment $customerShipment)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->customerShipment
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('supplier_purchase_invoice_no', 'ilike', "%{$search}%");
                $query->orWhere('supplier_purchase_invoice_date', 'ilike', "%{$search}%");
                $query->orWhere('supplier_purchase_invoice_amount', 'ilike', "%{$search}%");
                $query->orWhere('shipment_date', 'ilike', "%{$search}%");
                $query->orWhere('shipment_invoice_amount', 'ilike', "%{$search}%");
                $query->orWhere('exit_tonnage', 'ilike', "%{$search}%");
                $query->orWhere('different_shipping_amount_status', 'ilike', "%{$search}%");
                $query->orWhere('arrival_tonnage', 'ilike', "%{$search}%");
                $query->orWhere('different_tonnage_status', 'ilike', "%{$search}%");
                $query->orWhere('product_invoice_no', 'ilike', "%{$search}%");
                $query->orWhere('product_invoice_date', 'ilike', "%{$search}%");
                $query->orWhere('product_invoice_amount_without_tax', 'ilike', "%{$search}%");
                $query->orWhere('product_tax_percentage', 'ilike', "%{$search}%");
                $query->orWhere('product_total_tax', 'ilike', "%{$search}%");
                $query->orWhere('product_invoice_total_amount', 'ilike', "%{$search}%");
                $query->orWhere('withholding', 'ilike', "%{$search}%");
            })
            ->with('productType', 'city', 'customer', 'company', 'shipment')
            ->paginate($perPage);
    }

    public function bulkInvoiceUpdate(Collection $customerShipments, array $data): void
    {
        foreach ($customerShipments as $customerShipment) {
            $customerShipment->update($data);
        }
    }
}
