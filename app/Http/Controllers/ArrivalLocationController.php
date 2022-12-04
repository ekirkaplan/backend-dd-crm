<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ArrivalLocation\StoreRequest;
use App\Http\Requests\ArrivalLocation\UpdateRequest;
use App\Models\ArrivalLocation;
use App\Repositories\ArrivalLocationRepository;
use App\Repositories\BaseRepository;
use App\Services\ArrivalLocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArrivalLocationController extends Controller
{
    public function __construct(
        private BaseRepository $baseRepository,
        private ArrivalLocationRepository $arrivalLocationRepository,
        private ArrivalLocationService $arrivalLocationService
    )
    {
        $this->baseRepository->init(new ArrivalLocation());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $arrivalLocations = $this->baseRepository->getAll();
        $arrivalLocations = $this->arrivalLocationService->setPlural($arrivalLocations);
        return JsonOutputFaced::setData($arrivalLocations)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $arrivalLocations = $this->arrivalLocationRepository->getFiltered($search);
        return JsonOutputFaced::setData($arrivalLocations)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::setMessage('Varış Lokasyonu eklendi')->response();
    }

    /**
     * @param  ArrivalLocation  $arrivalLocation
     * @return JsonResponse
     */
    public function show(ArrivalLocation $arrivalLocation): JsonResponse
    {
        $arrivalLocation = $this->arrivalLocationService->setSingle($arrivalLocation);
        return JsonOutputFaced::setData($arrivalLocation)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ArrivalLocation  $arrivalLocation
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ArrivalLocation $arrivalLocation): JsonResponse
    {
        $this->baseRepository->update($arrivalLocation, $request->validated());
        return JsonOutputFaced::setMessage('Varış Lokasyonu Güncellendi')->response();
    }

    /**
     * @param  ArrivalLocation  $arrivalLocation
     * @return JsonResponse
     */
    public function destroy(ArrivalLocation $arrivalLocation): JsonResponse
    {
        $this->baseRepository->destroy($arrivalLocation);
        return JsonOutputFaced::setMessage('Varış Lokasyonu Silindi')->response();
    }
}
