<?php

namespace App\Repositories;

use App\Interfaces\SquadInterface;
use App\Models\Squad;
use Illuminate\Contracts\Pagination\Paginator;

class SquadRepository implements SquadInterface
{
    /**
     * @param  Squad  $squad
     */
    public function __construct(protected Squad $squad)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->squad
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->with('employees')
            ->paginate($perPage);
    }

    /**
     * @param  Squad  $squad
     * @param  array  $data
     * @return void
     */
    public function sync(Squad $squad, array $data): void
    {
        $squad->employees()->sync($data);
    }
}
