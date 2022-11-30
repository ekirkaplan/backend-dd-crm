<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private EmployeeRepository $employeeRepository)
    {
        $this->baseRepository->init(new Employee());
    }

    public function getAll(): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->getAll())->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        return JsonOutputFaced::setData($this->employeeRepository->getFiltered($search))->response();
    }

    public function store(StoreRequest $request)
    {
        return JsonOutputFaced::setData($this->baseRepository->store($request->validated()))->response();
    }

    public function show(Employee $employee): JsonResponse
    {
        return JsonOutputFaced::setData($employee)->response();
    }

    public function update(UpdateRequest $request, Employee $employee): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($employee, $request->validated()))->response();
    }

    public function destroy(Employee $employee): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($employee))->response();
    }
}
