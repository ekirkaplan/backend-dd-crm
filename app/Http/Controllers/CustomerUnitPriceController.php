<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\CustomerUnitPrice\StoreRequest;
use App\Http\Requests\CustomerUnitPrice\UpdateRequest;
use App\Models\Customer;
use App\Models\CustomerUnitPrice;
use App\Models\ProductType;
use App\Repositories\BaseRepository;
use App\Repositories\CustomerUnitPriceRepository;
use App\Services\CustomerUnitPriceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerUnitPriceController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param CustomerUnitPriceRepository $customerUnitPriceRepository
     * @param CustomerUnitPriceService $customerUnitPriceService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private CustomerUnitPriceRepository $customerUnitPriceRepository,
        private CustomerUnitPriceService $customerUnitPriceService
    )
    {
        $this->baseRepository->init(new CustomerUnitPrice());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $customerUnitPrices = $this->baseRepository->getAll();
        $customerUnitPrices = $this->customerUnitPriceService->setPlural($customerUnitPrices);
        return JsonOutputFaced::setData($customerUnitPrices)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $customerUnitPrices = $this->customerUnitPriceRepository->getFiltered($search);
        return JsonOutputFaced::setData($customerUnitPrices)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::setMessage('Müşteri Birim Fiyat Eklendi')->response();
    }

    /**
     * @param  CustomerUnitPrice  $customerUnitPrice
     * @return JsonResponse
     */
    public function show(CustomerUnitPrice $customerUnitPrice): JsonResponse
    {
        $customerUnitPrice = $this->customerUnitPriceService->setSingle($customerUnitPrice);
        return JsonOutputFaced::setData($customerUnitPrice)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  CustomerUnitPrice  $customerUnitPrice
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, CustomerUnitPrice $customerUnitPrice): JsonResponse
    {
        $this->baseRepository->update($customerUnitPrice, $request->validated());
        return JsonOutputFaced::setMessage('Müşteri Birim Fiyat Güncellendi')->response();
    }

    /**
     * @param  CustomerUnitPrice  $customerUnitPrice
     * @return JsonResponse
     */
    public function destroy(CustomerUnitPrice $customerUnitPrice): JsonResponse
    {
        $this->baseRepository->destroy($customerUnitPrice);
        return JsonOutputFaced::setMessage('Müşteri Birim Fiyat Silindi')->response();
    }

    public function getForProductType(Customer $customer, ProductType $productType): JsonResponse
    {
        $data = $this->customerUnitPriceService->setSingle($this->customerUnitPriceRepository->getForProductType($customer, $productType));

        return JsonOutputFaced::setData($data)->response();
    }
}
