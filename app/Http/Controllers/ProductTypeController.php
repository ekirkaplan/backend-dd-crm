<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ProductType\StoreRequest;
use App\Http\Requests\ProductType\UpdateRequest;
use App\Models\ProductType;
use App\Repositories\BaseRepository;
use App\Repositories\ProductTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  ProductTypeRepository  $productTypeRepository
     */
    public function __construct(private BaseRepository $baseRepository, private ProductTypeRepository $productTypeRepository)
    {
        $this->baseRepository->init(new ProductType());
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

        return JsonOutputFaced::setData($this->productTypeRepository->getFiltered($search))->response();
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
     * @param  ProductType  $productType
     * @return JsonResponse
     */
    public function show(ProductType $productType): JsonResponse
    {
        return JsonOutputFaced::setData($productType)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ProductType  $productType
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ProductType $productType): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($productType, $request->validated()))->response();
    }

    /**
     * @param  ProductType  $productType
     * @return JsonResponse
     */
    public function destroy(ProductType $productType): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($productType))->response();
    }
}
