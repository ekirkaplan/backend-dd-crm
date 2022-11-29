<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Models\Company;
use App\Repositories\BaseRepository;
use App\Repositories\CompanyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  CompanyRepository  $companyRepository
     */
    public function __construct(private BaseRepository $baseRepository, private CompanyRepository $companyRepository)
    {
        $this->baseRepository->init(new Company());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->getAll())->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->companyRepository->getFiltered($search))->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->store($request->validated()))->response();
    }

    /**
     * @param  Company  $company
     * @return JsonResponse
     */
    public function show(Company $company): JsonResponse
    {
        return JsonOutputFaced::setData($company)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Company  $company
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Company $company): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($company, $request->validated()))->response();
    }

    /**
     * @param  Company  $company
     * @return JsonResponse
     */
    public function destroy(Company $company): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($company))->response();
    }
}
