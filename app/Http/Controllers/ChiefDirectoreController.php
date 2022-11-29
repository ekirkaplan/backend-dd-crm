<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ChiefDirectore\StoreRequest;
use App\Http\Requests\ChiefDirectore\UpdateRequest;
use App\Models\ChiefDirectore;
use App\Repositories\BaseRepository;
use App\Repositories\ChiefDirectoreRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChiefDirectoreController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  ChiefDirectoreRepository  $chiefDirectoreRepository
     */
    public function __construct(private BaseRepository $baseRepository, private ChiefDirectoreRepository $chiefDirectoreRepository)
    {
        $this->baseRepository->init(new ChiefDirectore());
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

        return JsonOutputFaced::setData($this->chiefDirectoreRepository->getFiltered($search))->response();
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
     * @param  ChiefDirectore  $chiefDirectore
     * @return JsonResponse
     */
    public function show(ChiefDirectore $chiefDirectore): JsonResponse
    {
        return JsonOutputFaced::setData($chiefDirectore)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ChiefDirectore  $chiefDirectore
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ChiefDirectore $chiefDirectore): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($chiefDirectore, $request->validate()))->response();
    }

    /**
     * @param  ChiefDirectore  $chiefDirectore
     * @return JsonResponse
     */
    public function destroy(ChiefDirectore $chiefDirectore): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($chiefDirectore))->response();
    }
}
