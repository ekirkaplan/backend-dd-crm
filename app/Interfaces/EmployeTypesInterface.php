<?php

namespace App\Interfaces;

use App\Models\EmployeType;

interface EmployeTypesInterface extends FilteredInterface
{
    /**
     * @param array $data
     * @return EmployeType
     */
    public function store(array $data): EmployeType;

    /**
     * @param EmployeType $employeType
     * @param array $data
     * @return EmployeType
     */
    public function update(EmployeType $employeType, array $data): EmployeType;
}
