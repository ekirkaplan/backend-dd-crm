<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Services\CustomerShipmentService;
use App\Http\Requests\CustomerShipment\StoreRequest;
use App\Http\Requests\CustomerShipment\UpdateRequest;
use App\Models\CustomerShipment;
use App\Repositories\BaseRepository;
use App\Repositories\CustomerShipmentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerShipmentController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param CustomerShipmentRepository $customerShipmentRepository
     * @param CustomerShipmentService $customerShipmentService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private CustomerShipmentRepository $customerShipmentRepository,
        private CustomerShipmentService $customerShipmentService
    )
    {
        $this->baseRepository->init(new CustomerShipment());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $customerShipments = $this->baseRepository->getAll();
        $customerShipments = $this->customerShipmentService->setPlural($customerShipments);
        return JsonOutputFaced::setData($customerShipments)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $customerShipments = $this->customerShipmentRepository->getFiltered($search);
        return JsonOutputFaced::setData($customerShipments)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::setMessage('Müşteri Sevkiyat Ekledi')->response();
    }

    /**
     * @param  CustomerShipment  $customerShipment
     * @return JsonResponse
     */
    public function show(CustomerShipment $customerShipment): JsonResponse
    {
        $customerShipment = $this->customerShipmentService->setSingle($customerShipment);
        return JsonOutputFaced::setData($customerShipment)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  CustomerShipment  $customerShipment
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, CustomerShipment $customerShipment): JsonResponse
    {
        $this->baseRepository->update($customerShipment, $request->validated());
        return JsonOutputFaced::setMessage('Müşteri Sevkiyat Güncellendi')->response();
    }

    /**
     * @param  CustomerShipment  $customerShipment
     * @return JsonResponse
     */
    public function destroy(CustomerShipment $customerShipment): JsonResponse
    {
        $this->baseRepository->destroy($customerShipment);
        return JsonOutputFaced::setMessage('Müşteri Sevkiyat Silindi')->response();
    }
}
