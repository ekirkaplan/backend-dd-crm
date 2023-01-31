<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Models\ExitWarehouse;
use App\Models\Squad;
use App\Models\Supplier;
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
     * @param  BaseRepository  $baseRepository
     * @param  CustomerShipmentRepository  $customerShipmentRepository
     * @param  CustomerShipmentService  $customerShipmentService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private CustomerShipmentRepository $customerShipmentRepository,
        private CustomerShipmentService $customerShipmentService
    ) {
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
        $data = $request->except('exit_type');
        $data['exit_model_type'] = $this->exitTypeConverter($request->get('exit_type'));
        $this->baseRepository->store($data);

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
        $data = $request->except('exit_type');
        $data['exit_model_type'] = $this->exitTypeConverter($request->get('exit_type'));
        $this->baseRepository->update($customerShipment, $data);

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

    private function exitTypeConverter(int $type): string
    {
        if ($type === 0) {
            return ExitWarehouse::class;
        } elseif ($type === 1) {
            return Squad::class;
        } elseif ($type === 2) {
            return Supplier::class;
        }
    }
}
