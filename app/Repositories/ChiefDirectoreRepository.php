<?php

namespace App\Repositories;

use App\Interfaces\ChiefDirectoreInterface;
use App\Models\ChiefDirectore;
use Illuminate\Contracts\Pagination\Paginator;

class ChiefDirectoreRepository implements ChiefDirectoreInterface
{
    /**
     * @param ChiefDirectore $chiefDirectore
     */
    public function __construct(protected ChiefDirectore $chiefDirectore)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->chiefDirectore
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
