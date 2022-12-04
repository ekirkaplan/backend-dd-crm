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
    /**
     * @param BaseRepository $baseRepository
     * @param EmployeeRepository $employeeRepository
     * @param EmployeeService $employeeService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private EmployeeRepository $employeeRepository,
        private EmployeeService $employeeService
    )
    {
        $this->baseRepository->init(new Employee());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $employees = $this->baseRepository->getAll();
        $employees = $this->employeeService->setPlural($employees);
        return JsonOutputFaced::setData($employees)->response();
    }

    /**
     * @return JsonResponse
     */
    public function outOfSquad(): JsonResponse
    {
        $employees = $this->employeeRepository->outOfSquad();
        $employees = $this->employeeService->setPlural($employees);
        return JsonOutputFaced::setData($employees)->response();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $employees = $this->employeeRepository->getFiltered($search);
        return JsonOutputFaced::setData($employees)->response();
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::setMessage('Personel Eklendi')->response();
    }

    /**
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show(Employee $employee): JsonResponse
    {
        $employee = $this->employeeService->setSingle($employee);
        return JsonOutputFaced::setData($employee)->response();
    }

    /**
     * @param UpdateRequest $request
     * @param Employee $employee
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Employee $employee): JsonResponse
    {
        $this->baseRepository->update($employee, $request->validated());
        return JsonOutputFaced::setMessage('Personel Güncellendi')->response();
    }

    /**
     * @param Employee $employee
     * @return JsonResponse
     */
    public function destroy(Employee $employee): JsonResponse
    {
        $this->baseRepository->destroy($employee);
        return JsonOutputFaced::setMessage('Personel Silindi')->response();
    }
}
