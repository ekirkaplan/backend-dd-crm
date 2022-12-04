<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Employee;
use Illuminate\Contracts\Pagination\Paginator;

class EmployeeRepository implements EmployeeInterface
{
    /**
     * @param Employee $employee
     */
    public function __construct(protected Employee $employee)
    {
    }


    // TODO: If user has squad than do not show in the list!!!
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
            ->with('squads', 'companies')
            ->paginate($perPage);
    }

}
