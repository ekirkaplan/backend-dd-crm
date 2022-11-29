<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\CustomerUnitPrice\StoreRequest;
use App\Http\Requests\CustomerUnitPrice\UpdateRequest;
use App\Models\CustomerUnitPrice;
use App\Repositories\BaseRepository;
use App\Repositories\CustomerUnitPriceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerUnitPriceController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  CustomerUnitPriceRepository  $customerUnitPriceRepository
     */
    public function __construct(private BaseRepository $baseRepository, private CustomerUnitPriceRepository $customerUnitPriceRepository)
    {
        $this->baseRepository->init(new CustomerUnitPrice());
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

        return JsonOutputFaced::setData($this->customerUnitPriceRepository->getFiltered($search))->response();
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
     * @param  CustomerUnitPrice  $customerUnitPrice
     * @return JsonResponse
     */
    public function show(CustomerUnitPrice $customerUnitPrice): JsonResponse
    {
        return JsonOutputFaced::setData($customerUnitPrice)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  CustomerUnitPrice  $customerUnitPrice
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, CustomerUnitPrice $customerUnitPrice): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($customerUnitPrice, $request->validated()))->response();
    }

    /**
     * @param  CustomerUnitPrice  $customerUnitPrice
     * @return JsonResponse
     */
    public function destroy(CustomerUnitPrice $customerUnitPrice): JsonResponse
    {
        return JsonOutputFaced::setData($customerUnitPrice)->response();
    }
}
