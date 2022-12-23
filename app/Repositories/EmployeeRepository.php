<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Employee;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

class EmployeeRepository implements EmployeeInterface
{
    /**
     * @param Employee $employee
     */
    public function __construct(protected Employee $employee)
    {
    }

    /**
     * @return Collection
     */
    public function outOfSquadEmployee(): Collection
    {
            return $this->employee->whereDoesntHave('squads', function ($builder) {
                $builder->whereNull('end_date');
            })->where('type', 0)->get();
    }

    /**
     * @return Collection
     */
    public function outOfSquadForeman(): Collection
    {
        return $this->employee->where('type', 1)->whereDoesntHave('squadOfForeman')->get();
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->employee
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('first_name', 'ilike', "%{$search}%");
                $query->orWhere('last_name', 'ilike', "%{$search}%");
                $query->orWhere('phone', 'ilike', "%{$search}%");
            })
            ->with(['company'])
            ->orderBy('id')
            ->paginate($perPage);
    }

}
