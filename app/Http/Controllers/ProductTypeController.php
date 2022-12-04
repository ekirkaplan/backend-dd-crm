<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ProductType\StoreRequest;
use App\Http\Requests\ProductType\UpdateRequest;
use App\Models\ProductType;
use App\Repositories\BaseRepository;
use App\Repositories\ProductTypeRepository;
use App\Services\ProductTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  ProductTypeRepository  $productTypeRepository
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private ProductTypeRepository $productTypeRepository,
        private ProductTypeService $productTypeService
    )
    {
        $this->baseRepository->init(new ProductType());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $productTypeServices =  $this->baseRepository->getAll();
        $productTypeServices = $this->productTypeService->setPlural($productTypeServices);
        return JsonOutputFaced::setData($productTypeServices)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $productTypeServices = $this->productTypeRepository->getFiltered($search);
        return JsonOutputFaced::setData($productTypeServices)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::setMessage('Ürün Tipi Eklendi')->response();
    }

    /**
     * @param  ProductType  $productType
     * @return JsonResponse
     */
    public function show(ProductType $productType): JsonResponse
    {
        $productType = $this->productTypeService->setSingle($productType);
        return JsonOutputFaced::setData($productType)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ProductType  $productType
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ProductType $productType): JsonResponse
    {
        $this->baseRepository->update($productType, $request->validated());
        return JsonOutputFaced::setMessage('Ürün Tipi Güncellendi')->response();
    }

    /**
     * @param  ProductType  $productType
     * @return JsonResponse
     */
    public function destroy(ProductType $productType): JsonResponse
    {
        $this->baseRepository->destroy($productType);
        return JsonOutputFaced::setMessage('Ürün Tipi Silindi')->response();
    }
}
