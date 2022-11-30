<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\regionDirector\StoreRequest;
use App\Http\Requests\regionDirector\UpdateRequest;
use App\Models\RegionDirector;
use App\Repositories\BaseRepository;
use App\Repositories\RegionDirectorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegionDirectorController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  RegionDirectorRepository  $regionDirectorRepository
     */
    public function __construct(private BaseRepository $baseRepository, private RegionDirectorRepository $regionDirectorRepository)
    {
        $this->baseRepository->init(new RegionDirector());
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

        return JsonOutputFaced::setData($this->regionDirectorRepository->getFiltered($search))->response();
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
     * @param  RegionDirector  $regionDirector
     * @return JsonResponse
     */
    public function show(RegionDirector $regionDirector): JsonResponse
    {
        return JsonOutputFaced::setData($regionDirector)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  RegionDirector  $regionDirector
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, RegionDirector $regionDirector): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($regionDirector, $request->validated()))->response();
    }

    /**
     * @param  regionDirector  $regionDirector
     * @return JsonResponse
     */
    public function destroy(regionDirector $regionDirector): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($regionDirector))->response();
    }
}
