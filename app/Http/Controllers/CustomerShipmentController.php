<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\CustomerShipment\BulkInvoiceUpdateRequest;
use App\Models\ContractShipment;
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
     * @param BaseRepository $baseRepository
     * @param CustomerShipmentRepository $customerShipmentRepository
     * @param CustomerShipmentService $customerShipmentService
     */
    public function __construct(
        private BaseRepository             $baseRepository,
        private CustomerShipmentRepository $customerShipmentRepository,
        private CustomerShipmentService    $customerShipmentService
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
     * @param Request $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $customerShipments = $this->customerShipmentRepository->getFiltered($search);

        return JsonOutputFaced::setData($customerShipments)->response();
    }

    /**
     * @param StoreRequest $request
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
     * @param CustomerShipment $customerShipment
     * @return JsonResponse
     */
    public function show(CustomerShipment $customerShipment): JsonResponse
    {
        $customerShipment = $this->customerShipmentService->setSingle($customerShipment);

        return JsonOutputFaced::setData($customerShipment)->response();
    }

    /**
     * @param UpdateRequest $request
     * @param CustomerShipment $customerShipment
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
     * @param CustomerShipment $customerShipment
     * @return JsonResponse
     */
    public function destroy(CustomerShipment $customerShipment): JsonResponse
    {
        $this->baseRepository->destroy($customerShipment);

        return JsonOutputFaced::setMessage('Müşteri Sevkiyat Silindi')->response();
    }

    public function bulkInvoiceUpdate(BulkInvoiceUpdateRequest $request): JsonResponse
    {
        $data = $request->only([
            'product_invoice_no',
            'product_invoice_date',
            'product_invoice_amount_without_tax',
            'product_tax_percentage',
            'product_invoice_total_amount',
            'withholding',
        ]);

        $contractData = [
            'invoice_no' => $request->get('product_invoice_no'),
            'tax_rate' => $request->get('product_tax_percentage'),
            'invoice_date' => $request->get('product_invoice_date'),
            'invoice_without_amount' => $request->get('product_invoice_amount_without_tax'),
            'invoice_total_amount' => $request->get('product_invoice_total_amount'),
            'invoice_withholding' => $request->get('withholding')
        ];

        $customerShipments = CustomerShipment::whereIn('id', $request->get('selectedCustomer'))->get();
        $contractShipments = ContractShipment::whereIn('id', $request->get('selectedContract'))->get();

        $this->customerShipmentRepository->bulkInvoiceUpdate($customerShipments, $data);

        foreach ($contractShipments as $contractShipment) {
            $contractShipment->update($contractData);
        }

        return JsonOutputFaced::setMessage('Fatura Bilgileri GÜncellendi')->response();

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
