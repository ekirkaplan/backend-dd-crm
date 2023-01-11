<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ContractShipment\StoreRequest;
use App\Http\Requests\ContractShipment\UpdateRequest;
use App\Models\ArrivalLocation;
use App\Models\Contract;
use App\Models\ContractShipment;
use App\Models\Squad;
use App\Repositories\BaseRepository;
use App\Repositories\ContractShipmentRepository;
use App\Services\ContractShipmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractShipmentController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  ContractShipmentRepository  $contractShipmentRepository
     * @param  ContractShipmentService  $contractShipmentService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private ContractShipmentRepository $contractShipmentRepository,
        private ContractShipmentService $contractShipmentService
    ) {
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
     * @param  Contract  $contract
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
        $shipments = $request->validated();
        $shipments['arrival_calc_amount'] = $this->shipmentsCalc(ArrivalLocation::find($request->get('arrival_location_id')), $request->get('arrival_tonnage'));
        $shipments['squad_calc_amount'] = $this->squadCalc(Squad::find($request->get('squad_id')), $request->get('exit_date'), $request->get('arrival_tonnage'));

        $this->baseRepository->store($shipments);

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
        $shipments = $request->validated();
        $shipments['arrival_calc_amount'] = $this->shipmentsCalc(ArrivalLocation::find($request->get('arrival_location_id')), $request->get('arrival_tonnage'));
        $shipments['squad_calc_amount'] = $this->squadCalc(Squad::find($request->get('squad_id')), $request->get('exit_date'), $request->get('arrival_tonnage'));

        $this->baseRepository->update($contractShipment, $shipments);

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

    private function shipmentsCalc(ArrivalLocation $arrivalLocation, $arrivalTonnage)
    {
        return $arrivalLocation->transport_unit_price * (int)$arrivalTonnage;
    }

    private function squadCalc(Squad $squad, string $date, $arrivalTonnage)
    {
        $unitPrice = $squad->unitPrices()
            ->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->first();
        if (is_null($unitPrice)) {
            return 0;
        } else {
            return $unitPrice->price * (int)$arrivalTonnage;
        }
    }
}
