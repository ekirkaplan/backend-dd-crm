<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ChiefDirector\StoreRequest;
use App\Http\Requests\ChiefDirector\UpdateRequest;
use App\Models\ChiefDirector;
use App\Repositories\BaseRepository;
use App\Repositories\ChiefDirectorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChiefDirectorController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  ChiefDirectorRepository  $chiefDirectorRepository
     */
    public function __construct(private BaseRepository $baseRepository, private ChiefDirectorRepository $chiefDirectorRepository)
    {
        $this->baseRepository->init(new ChiefDirector());
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

        return JsonOutputFaced::setData($this->chiefDirectorRepository->getFiltered($search))->response();
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
     * @param  ChiefDirector  $chiefDirector
     * @return JsonResponse
     */
    public function show(ChiefDirector $chiefDirector): JsonResponse
    {
        return JsonOutputFaced::setData($chiefDirector)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ChiefDirector  $chiefDirector
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ChiefDirector $chiefDirector): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($chiefDirector, $request->validated()))->response();
    }

    /**
     * @param  ChiefDirector  $chiefDirector
     * @return JsonResponse
     */
    public function destroy(ChiefDirector $chiefDirector): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($chiefDirector))->response();
    }
}
