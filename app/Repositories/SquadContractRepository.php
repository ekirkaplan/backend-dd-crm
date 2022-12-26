<?php

namespace App\Repositories;

use App\Interfaces\SquadContractInterface;
use App\Models\SquadContract;
use Illuminate\Contracts\Pagination\Paginator;

class SquadContractRepository implements SquadContractInterface
{
    /**
     * @param SquadContract $squadContract
     */
    public function __construct(protected SquadContract $squadContract)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->squadContract
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('start_date', 'ilike', "%{$search}%");
                $query->orWhere('end_date', 'ilike', "%{$search}%");
            })->with(['squad', 'contract'])
            ->paginate($perPage);
    }
}
