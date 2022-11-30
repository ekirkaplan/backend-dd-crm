<?php

namespace App\Services;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeService
{
    /**
     * @param Employee $employee
     * @return EmployeeResource
     */
    public function setSingle(Employee $employee): EmployeeResource
    {
        return new EmployeeResource($employee);
    }

    /**
     * @param Collection $employees
     * @return JsonResource
     */
    public function setPlural(Collection $employees): JsonResource
    {
        return EmployeeResource::collection($employees);
    }
}
