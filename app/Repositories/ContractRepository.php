<?php

namespace App\Repositories;

use App\Interfaces\ContractInterface;
use App\Models\Contract;
use Illuminate\Contracts\Pagination\Paginator;

class ContractRepository implements ContractInterface
{
    /**
     * @param Contract $contract
     */
    public function __construct(protected Contract $contract)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->contract
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('stack_no', 'ilike', "%{$search}%");
                $query->orWhere('parcel_no', 'ilike', "%{$search}%");
                $query->orWhere('cubic_meter', 'ilike', "%{$search}%");
                $query->orWhere('forward_sale_price', 'ilike', "%{$search}%");
                $query->orWhere('contract_stamp_duty', 'ilike', "%{$search}%");
                $query->orWhere('contract_invoice_date', 'ilike', "%{$search}%");
            })->with(['chiefDirector', 'regionDirector', 'exitWarehouse', 'productType'])
            ->paginate($perPage);
    }
}
