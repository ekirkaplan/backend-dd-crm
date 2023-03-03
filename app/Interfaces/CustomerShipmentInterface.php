<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CustomerShipmentInterface extends FilteredInterface
{
    /**
     * @param  Collection  $customerShipments
     * @param  array  $data
     * @return void
     */
    public function bulkInvoiceUpdate(Collection $customerShipments, array $data): void;
}
