<?php

namespace App\Repositories;

use App\Interfaces\ChiefdomInterface;
use App\Models\ChiefDirector;
use App\Models\Chiefdom;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class ChiefdomRepository implements ChiefdomInterface
{
    /**
     * @param  Chiefdom  $chiefdom
     */
    public function __construct(protected Chiefdom $chiefdom)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->chiefdom
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }

    /**
     * @param  ChiefDirector  $chiefDirector
     * @return Collection
     */
    public function getByChiefDirector(ChiefDirector $chiefDirector): Collection
    {
        return $this->chiefdom->query()->where('chief_director_id', $chiefDirector->id)->get();
    }
}
