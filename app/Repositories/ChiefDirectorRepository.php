<?php

namespace App\Repositories;

use App\Interfaces\ChiefDirectorInterface;
use App\Models\ChiefDirector;
use Illuminate\Contracts\Pagination\Paginator;

class ChiefDirectorRepository implements ChiefDirectorInterface
{
    /**
     * @param ChiefDirector $chiefDirector
     */
    public function __construct(protected ChiefDirector $chiefDirector)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->chiefDirector
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->with('regionDirector')
            ->paginate($perPage);
    }
}
