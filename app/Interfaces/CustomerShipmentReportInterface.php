<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CustomerShipmentReportInterface
{
    /**
     * @param array $filter
     * @return Collection
     */
    public function getReport(array $filter): Collection;
}
