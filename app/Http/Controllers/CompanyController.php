<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Models\Company;
use App\Repositories\BaseRepository;
use App\Repositories\CompanyRepository;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param CompanyRepository $companyRepository
     * @param CompanyService $companyService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private CompanyRepository $companyRepository,
        private CompanyService $companyService
    )
    {
        $this->baseRepository->init(new Company());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $companies = $this->baseRepository->getAll();
        $companies = $this->companyService->setPlural($companies);
        return JsonOutputFaced::setData($companies)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $companies = $this->companyRepository->getFiltered($search);
        return JsonOutputFaced::setData($companies)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::response();
    }

    /**
     * @param  Company  $company
     * @return JsonResponse
     */
    public function show(Company $company): JsonResponse
    {
        $company = $this->companyService->setSingle($company);
        return JsonOutputFaced::setData($company)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Company  $company
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Company $company): JsonResponse
    {
        $this->baseRepository->update($company, $request->validated());
        return JsonOutputFaced::response();
    }

    /**
     * @param  Company  $company
     * @return JsonResponse
     */
    public function destroy(Company $company): JsonResponse
    {
        $this->baseRepository->destroy($company);
        return JsonOutputFaced::response();
    }
}
