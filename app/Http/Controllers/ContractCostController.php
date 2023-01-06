<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ContractCosts\StoreRequest;
use App\Http\Requests\ContractCosts\UpdateRequest;
use App\Models\ContractCost;
use App\Repositories\BaseRepository;
use App\Repositories\ContractCostRepository;
use App\Services\ContractCostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractCostController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  ContractCostRepository  $contractCostRepository
     * @param  ContractCostService  $contractCostService
     */
    public function __construct(private BaseRepository $baseRepository, private ContractCostRepository $contractCostRepository, private ContractCostService $contractCostService)
    {
        $this->baseRepository->init(new ContractCost());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $contractCosts = $this->contractCostService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($contractCosts)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->contractCostRepository->getFiltered($search))->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Gider Eklendi')->response();
    }

    /**
     * @param  ContractCost  $contractCost
     * @return JsonResponse
     */
    public function show(ContractCost $contractCost): JsonResponse
    {
        $contractCost = $this->contractCostService->setSingle($contractCost);

        return JsonOutputFaced::setData($contractCost)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ContractCost  $contractCost
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ContractCost $contractCost): JsonResponse
    {
        $this->baseRepository->update($contractCost, $request->validated());

        return JsonOutputFaced::setMessage('Gider Güncellendi')->response();
    }

    /**
     * @param  ContractCost  $contractCost
     * @return JsonResponse
     */
    public function destroy(ContractCost $contractCost): JsonResponse
    {
        $this->baseRepository->destroy($contractCost);

        return JsonOutputFaced::setMessage('Gider Eklendi')->response();
    }
}
