<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ArrivalLocation\StoreRequest;
use App\Http\Requests\ArrivalLocation\UpdateRequest;
use App\Models\ArrivalLocation;
use App\Repositories\ArrivalLocationRepository;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArrivalLocationController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  ArrivalLocationRepository  $arrivalLocationRepository
     */
    public function __construct(private BaseRepository $baseRepository, private ArrivalLocationRepository $arrivalLocationRepository)
    {
        $this->baseRepository->init(new ArrivalLocation());
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

        return JsonOutputFaced::setData($this->arrivalLocationRepository->getFiltered($search))->response();
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
     * @param  ArrivalLocation  $arrivalLocation
     * @return JsonResponse
     */
    public function show(ArrivalLocation $arrivalLocation): JsonResponse
    {
        return JsonOutputFaced::setData($arrivalLocation)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ArrivalLocation  $arrivalLocation
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ArrivalLocation $arrivalLocation)
    {
        return JsonOutputFaced::setData($this->baseRepository->update($arrivalLocation, $request->validated()))->response();
    }

    /**
     * @param  ArrivalLocation  $arrivalLocation
     * @return JsonResponse
     */
    public function destroy(ArrivalLocation $arrivalLocation): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($arrivalLocation))->response();
    }
}
