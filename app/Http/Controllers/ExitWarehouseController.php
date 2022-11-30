<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ExitWarehouse\StoreRequest;
use App\Http\Requests\ExitWarehouse\UpdateRequest;
use App\Models\ExitWarehouse;
use App\Repositories\BaseRepository;
use App\Repositories\ExitWarehouseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExitWarehouseController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  ExitWarehouseRepository  $exitWarehouseRepository
     */
    public function __construct(private BaseRepository $baseRepository, private ExitWarehouseRepository $exitWarehouseRepository)
    {
        $this->baseRepository->init(new ExitWarehouse());
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

        return JsonOutputFaced::setData($this->exitWarehouseRepository->getFiltered($search))->response();
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
     * @param  ExitWarehouse  $exitWarehouse
     * @return JsonResponse
     */
    public function show(ExitWarehouse $exitWarehouse): JsonResponse
    {
        return JsonOutputFaced::setData($exitWarehouse)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ExitWarehouse  $exitWarehouse
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ExitWarehouse $exitWarehouse): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($exitWarehouse, $request->validated()))->response();
    }

    /**
     * @param  ExitWarehouse  $exitWarehouse
     * @return JsonResponse
     */
    public function destroy(ExitWarehouse $exitWarehouse): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($exitWarehouse))->response();
    }
}
