<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Shipment\StoreRequest;
use App\Http\Requests\Shipment\UpdateRequest;
use App\Models\Shipment;
use App\Repositories\BaseRepository;
use App\Repositories\ShipmentRepository;
use App\Services\ShipmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private ShipmentRepository $shipmentRepository, private ShipmentService $shipmentService)
    {
        $this->baseRepository->init(new Shipment());
    }

    public function getAll(): JsonResponse
    {
        $shipments = $this->shipmentService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($shipments)->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->shipmentRepository->getFiltered($search))->response();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage("Sevkiyat Nakliye Tanımı Oluşturuldu")->response();
    }

    public function show(Shipment $shipment): JsonResponse
    {
        $shipment = $this->shipmentService->setSingle($shipment);

        return JsonOutputFaced::setData($shipment)->response();
    }

    public function update(UpdateRequest $request, Shipment $shipment): JsonResponse
    {
        $this->baseRepository->update($shipment, $request->validated());

        return JsonOutputFaced::setMessage("Sevkiyat Nakliye Tanımı Kayıt Edildi")->response();
    }

    public function destroy(Shipment $shipment): JsonResponse
    {
        $this->baseRepository->destroy($shipment);

        return JsonOutputFaced::setMessage("Sevkiyat Nakliye Tanımı Silindi")->response();
    }
}
