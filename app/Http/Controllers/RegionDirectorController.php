<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\RegionDirector\StoreRequest;
use App\Http\Requests\RegionDirector\UpdateRequest;
use App\Models\RegionDirector;
use App\Repositories\BaseRepository;
use App\Repositories\RegionDirectorRepository;
use App\Services\RegionDirectorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegionDirectorController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param RegionDirectorRepository $regionDirectorRepository
     * @param RegionDirectorService $regionDirectorService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private RegionDirectorRepository $regionDirectorRepository,
        private RegionDirectorService $regionDirectorService
    )
    {
        $this->baseRepository->init(new RegionDirector());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $regionDirectors = $this->baseRepository->getAll();
        $regionDirectors = $this->regionDirectorService->setPlural($regionDirectors);
        return JsonOutputFaced::setData($regionDirectors)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $regionDirectors = $this->regionDirectorRepository->getFiltered($search);
        return JsonOutputFaced::setData($regionDirectors)->response();
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
     * @param  RegionDirector  $regionDirector
     * @return JsonResponse
     */
    public function show(RegionDirector $regionDirector): JsonResponse
    {
        $regionDirector = $this->regionDirectorService->setSingle($regionDirector);
        return JsonOutputFaced::setData($regionDirector)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  RegionDirector  $regionDirector
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, RegionDirector $regionDirector): JsonResponse
    {
        $this->baseRepository->update($regionDirector, $request->validated());
        return JsonOutputFaced::response();
    }

    /**
     * @param  regionDirector  $regionDirector
     * @return JsonResponse
     */
    public function destroy(regionDirector $regionDirector): JsonResponse
    {
        $this->baseRepository->destroy($regionDirector);
        return JsonOutputFaced::response();
    }
}
