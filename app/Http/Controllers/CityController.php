<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\City\StoreRequest;
use App\Http\Requests\City\UpdateRequest;
use App\Models\City;
use App\Repositories\BaseRepository;
use App\Repositories\CityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  CityRepository  $cityRepository
     */
    public function __construct(private BaseRepository $baseRepository, private CityRepository $cityRepository)
    {
        $this->baseRepository->init(new City());
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

        return JsonOutputFaced::setData($this->cityRepository->getFiltered($search))->response();
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
     * @param  City  $city
     * @return JsonResponse
     */
    public function show(City $city): JsonResponse
    {
        return JsonOutputFaced::setData($city)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  City  $city
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, City $city): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($city, $request->validated()))->response();
    }

    /**
     * @param  City  $city
     * @return JsonResponse
     */
    public function destroy(City $city): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($city))->response();
    }
}
