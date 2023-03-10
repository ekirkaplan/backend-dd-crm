<?php

namespace App\Repositories;

use App\Interfaces\CustomerShipmentReportInterface;
use App\Models\CustomerShipment;
use App\Models\CustomerShipmentReport;
use Illuminate\Database\Eloquent\Collection;

class CustomerShipmentReportRepository implements CustomerShipmentReportInterface
{
    /**
     * @param  CustomerShipment  $customerShipment
     */
    public function __construct(protected CustomerShipment $customerShipment)
    {
    }

    public function getReport(array $filter): Collection
    {
        return $this->customerShipment ->whereHas('shipment', function ($query) use ($filter) {
            $query->where('vehicle_plate', 'ilike',"%{$filter['plate']}%");
        })->whereBetween('shipment_date', [$filter['start_date'], $filter['end_date']])
            ->orWhere('customer_id', $filter['customer_id'])
            ->get();
    }
}
