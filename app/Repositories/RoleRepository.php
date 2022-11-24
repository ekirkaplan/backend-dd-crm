<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use App\Models\Role;
use Illuminate\Contracts\Pagination\Paginator;

class RoleRepository implements RoleInterface
{
    /**
     * @param Role $role
     */
    public function __construct(protected Role $role)
    {
    }

    /**
     * @param string|null $search
     * @param int $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->role
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
