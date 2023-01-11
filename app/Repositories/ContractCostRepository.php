<?php

namespace App\Repositories;

use App\Interfaces\ContractCostInterface;
use App\Models\ContractCost;
use Illuminate\Contracts\Pagination\Paginator;

class ContractCostRepository
{
    /**
     * @param ContractCost $contractCost
     */
    public function __construct(protected ContractCost $contractCost)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10)
    {
        return $this->contractCost
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('cost_amount', 'ilike', "%{$search}%");
            })->with(['contract', 'costType', 'squad'])
            ->get()
            ->groupBy('contract_id');
    }
}
