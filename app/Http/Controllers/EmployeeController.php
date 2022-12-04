<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Repositories\EmployeeRepository;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(
        private BaseRepository $baseRepository,
        private EmployeeRepository $employeeRepository,
        private EmployeeService $employeeService
    )
    {
        $this->baseRepository->init(new Employee());
    }

    public function getAll(): JsonResponse
    {
        $employees = $this->baseRepository->getAll();
        $employees = $this->employeeService->setPlural($employees);
        return JsonOutputFaced::setData($employees)->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $employees = $this->employeeRepository->getFiltered($search);
        return JsonOutputFaced::setData($employees)->response();
    }

    public function store(StoreRequest $request)
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::response();
    }

    public function show(Employee $employee): JsonResponse
    {
        $employee = $this->employeeService->setSingle($employee);
        return JsonOutputFaced::setData($employee)->response();
    }

    public function update(UpdateRequest $request, Employee $employee): JsonResponse
    {
        $this->baseRepository->update($employee, $request->validated());
        return JsonOutputFaced::response();
    }

    public function destroy(Employee $employee): JsonResponse
    {
        $this->baseRepository->destroy($employee);
        return JsonOutputFaced::response();
    }
}
