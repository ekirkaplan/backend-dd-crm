<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\City\StoreRequest;
use App\Http\Requests\City\UpdateRequest;
use App\Models\City;
use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Repositories\CityRepository;
use App\Services\CityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  CityRepository  $cityRepository
     * @param  CityService  $cityService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private CityRepository $cityRepository,
        private CityService $cityService
    ) {
        $this->baseRepository->init(new City());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $cities = $this->baseRepository->getAll();
        $cities = $this->cityService->setPlural($cities);

        return JsonOutputFaced::setData($cities)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $cities = $this->cityRepository->getFiltered($search);

        return JsonOutputFaced::setData($cities)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Şehir Eklendi')->response();
    }

    /**
     * @param  City  $city
     * @return JsonResponse
     */
    public function show(City $city): JsonResponse
    {
        $city = $this->cityService->setSingle($city);

        return JsonOutputFaced::setData($city)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  City  $city
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, City $city): JsonResponse
    {
        $this->baseRepository->update($city, $request->validated());

        return JsonOutputFaced::setMessage('Şehir Güncellendi')->response();
    }

    /**
     * @param  City  $city
     * @return JsonResponse
     */
    public function destroy(City $city): JsonResponse
    {
        $this->baseRepository->destroy($city);

        return JsonOutputFaced::setMessage('Şehir Silindi')->response();
    }
}
