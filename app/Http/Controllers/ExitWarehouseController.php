<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ExitWarehouse\StoreRequest;
use App\Http\Requests\ExitWarehouse\UpdateRequest;
use App\Models\ExitWarehouse;
use App\Repositories\BaseRepository;
use App\Repositories\ExitWarehouseRepository;
use App\Services\ExitWareHouseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExitWarehouseController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param ExitWarehouseRepository $exitWarehouseRepository
     * @param ExitWareHouseService $exitWareHouseService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private ExitWarehouseRepository $exitWarehouseRepository,
        private ExitWareHouseService $exitWareHouseService
    )
    {
        $this->baseRepository->init(new ExitWarehouse());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $exitWareHouses = $this->baseRepository->getAll();
        $exitWareHouses = $this->exitWareHouseService->setPlural($exitWareHouses);
        return JsonOutputFaced::setData($exitWareHouses)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $exitWareHouses = $this->exitWarehouseRepository->getFiltered($search);
        return JsonOutputFaced::setData($exitWareHouses)->response();
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
     * @param  ExitWarehouse  $exitWarehouse
     * @return JsonResponse
     */
    public function show(ExitWarehouse $exitWarehouse): JsonResponse
    {
        $exitWarehouse = $this->exitWareHouseService->setSingle($exitWarehouse);
        return JsonOutputFaced::setData($exitWarehouse)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ExitWarehouse  $exitWarehouse
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ExitWarehouse $exitWarehouse): JsonResponse
    {
        $this->baseRepository->update($exitWarehouse, $request->validated());
        return JsonOutputFaced::response();
    }

    /**
     * @param  ExitWarehouse  $exitWarehouse
     * @return JsonResponse
     */
    public function destroy(ExitWarehouse $exitWarehouse): JsonResponse
    {
        $this->baseRepository->destroy($exitWarehouse);
        return JsonOutputFaced::response();
    }
}
