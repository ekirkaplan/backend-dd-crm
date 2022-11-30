<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Models\Customer;
use App\Repositories\BaseRepository;
use App\Repositories\CustomerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  CustomerRepository  $customerRepository
     */
    public function __construct(private BaseRepository $baseRepository, private CustomerRepository $customerRepository)
    {
        $this->baseRepository->init(new Customer());
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

        return JsonOutputFaced::setData($this->customerRepository->getFiltered($search))->response();
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
     * @param  Customer  $customer
     * @return JsonResponse
     */
    public function show(Customer $customer): JsonResponse
    {
        return JsonOutputFaced::setData($customer)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Customer  $customer
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Customer $customer): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($customer, $request->validated()))->response();
    }

    /**
     * @param  Customer  $customer
     * @return JsonResponse
     */
    public function destroy(Customer $customer): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($customer))->response();
    }
}
