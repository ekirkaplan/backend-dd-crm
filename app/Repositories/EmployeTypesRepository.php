<?php

namespace App\Repositories;

use App\Interfaces\BaseInterface;
use App\Interfaces\EmployeTypesInterface;

use App\Models\EmployeType;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

class EmployeTypesRepository implements EmployeTypesInterface
{
    public function __construct(protected EmployeType $employeType)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->employeType
            ->query()
            ->orWhere('name', 'ilike', '%'.$search.'%')
            ->paginate($perPage);
    }

    public function store(array $data): EmployeType
    {
        return $this->employeType->create($data);
    }

    public function update(EmployeType $employeType, array $data): EmployeType
    {
        $employeType->update($data);

        return $employeType;
    }
}
