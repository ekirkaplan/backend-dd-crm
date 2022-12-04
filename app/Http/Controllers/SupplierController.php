<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Supplier\StoreRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Models\Supplier;
use App\Repositories\BaseRepository;
use App\Repositories\SupplierRepository;
use App\Services\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  SupplierRepository  $supplierRepository
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private SupplierRepository $supplierRepository,
        private SupplierService $supplierService
    )
    {
        $this->baseRepository->init(new Supplier());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $suppliers = $this->baseRepository->getAll();
        $suppliers = $this->supplierService->setPlural($suppliers);
        return JsonOutputFaced::setData($suppliers)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $suppliers = $this->supplierRepository->getFiltered($search);
        return JsonOutputFaced::setData($suppliers)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::response();
    }

    /**
     * @param  Supplier  $supplier
     * @return JsonResponse
     */
    public function show(Supplier $supplier): JsonResponse
    {
        $supplier = $this->supplierService->setSingle($supplier);
        return JsonOutputFaced::setData($supplier)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Supplier  $supplier
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Supplier $supplier)
    {
        $this->baseRepository->update($supplier, $request->validated());
        return JsonOutputFaced::response();
    }

    /**
     * @param  Supplier  $supplier
     * @return JsonResponse
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        $this->baseRepository->destroy($supplier);
        return JsonOutputFaced::response();
    }
}
