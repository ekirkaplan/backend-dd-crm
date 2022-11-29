<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Supplier\StoreRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Models\Supplier;
use App\Repositories\BaseRepository;
use App\Repositories\SupplierRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  SupplierRepository  $supplierRepository
     */
    public function __construct(private BaseRepository $baseRepository, private SupplierRepository $supplierRepository)
    {
        $this->baseRepository->init(new Supplier());
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

        return JsonOutputFaced::setData($this->supplierRepository->getFiltered($search))->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->store($request->validate()))->response();
    }

    /**
     * @param  Supplier  $supplier
     * @return JsonResponse
     */
    public function show(Supplier $supplier): JsonResponse
    {
        return JsonOutputFaced::setData($supplier)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Supplier  $supplier
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Supplier $supplier)
    {
        return JsonOutputFaced::setData($this->baseRepository->update($supplier, $request->validate()))->response();
    }

    /**
     * @param  Supplier  $supplier
     * @return JsonResponse
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($supplier))->response();
    }
}
