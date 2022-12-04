<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Models\Customer;
use App\Repositories\BaseRepository;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param CustomerRepository $customerRepository
     * @param CustomerService $customerService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private CustomerRepository $customerRepository,
        private CustomerService $customerService
    )
    {
        $this->baseRepository->init(new Customer());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $customers = $this->baseRepository->getAll();
        $customers = $this->customerService->setPlural($customers);
        return JsonOutputFaced::setData($customers)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $customers = $this->customerRepository->getFiltered($search);
        return JsonOutputFaced::setData($customers)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::setMessage('Müşteri Ekledi')->response();
    }

    /**
     * @param  Customer  $customer
     * @return JsonResponse
     */
    public function show(Customer $customer): JsonResponse
    {
        $cutsomer = $this->customerService->setSingle($customer);
        return JsonOutputFaced::setData($customer)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Customer  $customer
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Customer $customer): JsonResponse
    {
        $this->baseRepository->update($customer, $request->validated());
        return JsonOutputFaced::setMessage('Müşteri Güncellendi')->response();
    }

    /**
     * @param  Customer  $customer
     * @return JsonResponse
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $this->baseRepository->destroy($customer);
        return JsonOutputFaced::setMessage('Müşteri Silindi')->response();
    }
}
