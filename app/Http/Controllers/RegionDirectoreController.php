<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\RegionDirectore\StoreRequest;
use App\Http\Requests\RegionDirectore\UpdateRequest;
use App\Models\RegionDirectore;
use App\Repositories\BaseRepository;
use App\Repositories\RegionDirectoreRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegionDirectoreController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  RegionDirectoreRepository  $regionDirectoreRepository
     */
    public function __construct(private BaseRepository $baseRepository, private RegionDirectoreRepository $regionDirectoreRepository)
    {
        $this->baseRepository->init(new RegionDirectore());
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

        return JsonOutputFaced::setData($this->regionDirectoreRepository->getFiltered($search))->response();
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
     * @param  RegionDirectore  $regionDirectore
     * @return JsonResponse
     */
    public function show(RegionDirectore $regionDirectore): JsonResponse
    {
        return JsonOutputFaced::setData($regionDirectore)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  RegionDirectore  $regionDirectore
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, RegionDirectore $regionDirectore): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($regionDirectore, $request->validate()))->response();
    }

    /**
     * @param  RegionDirectore  $regionDirectore
     * @return JsonResponse
     */
    public function destroy(RegionDirectore $regionDirectore): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($regionDirectore))->response();
    }
}
