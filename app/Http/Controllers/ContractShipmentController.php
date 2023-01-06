<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ContractShipment\StoreRequest;
use App\Http\Requests\ContractShipment\UpdateRequest;
use App\Models\Contract;
use App\Models\ContractShipment;
use App\Repositories\BaseRepository;
use App\Repositories\ContractShipmentRepository;
use App\Services\ContractShipmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractShipmentController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param ContractShipmentRepository $contractShipmentRepository
     * @param ContractShipmentService $contractShipmentService
     */
    public function __construct(
        private BaseRepository             $baseRepository,
        private ContractShipmentRepository $contractShipmentRepository,
        private ContractShipmentService    $contractShipmentService
    )
    {
        $this->baseRepository->init(new ContractShipment());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $contractShipments = $this->baseRepository->getAll();
        $contractShipments = $this->contractShipmentService->setPlural($contractShipments);
        return JsonOutputFaced::setData($contractShipments)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $contractShipments = $this->contractShipmentRepository->getFiltered($search);
        return JsonOutputFaced::setData($contractShipments)->response();
    }

    /**
     * @param Contract $contract
     * @return JsonResponse
     */
    public function getGroupByContractId(Contract $contract): JsonResponse
    {
        $contractShipment = $this->contractShipmentRepository->getGroupByContractId($contract);
        $contractShipment = $this->contractShipmentService->setPlural($contractShipment);
        return JsonOutputFaced::setData($contractShipment)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::setMessage('Kontrat Sevkiyat Eklendi')->response();
    }

    /**
     * @param  ContractShipment  $contractShipment
     * @return JsonResponse
     */
    public function show(ContractShipment $contractShipment): JsonResponse
    {
        $contractShipment = $this->contractShipmentService->setSingle($contractShipment);
        return JsonOutputFaced::setData($contractShipment)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ContractShipment  $contractShipment
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ContractShipment $contractShipment): JsonResponse
    {
        $this->baseRepository->update($contractShipment, $request->validated());
        return JsonOutputFaced::setMessage('Kontrat Sevkiyat Güncellendi')->response();
    }

    /**
     * @param  ContractShipment  $contractShipment
     * @return JsonResponse
     */
    public function destroy(ContractShipment $contractShipment): JsonResponse
    {
        $this->baseRepository->destroy($contractShipment);
        return JsonOutputFaced::setMessage('Kontrat Sevkiyat Silindi')->response();
    }
}
