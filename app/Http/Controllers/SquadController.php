<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Squad\StoreRequest;
use App\Http\Requests\Squad\UpdateRequest;
use App\Models\Squad;
use App\Repositories\BaseRepository;
use App\Repositories\SquadRepository;
use App\Services\SquadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SquadController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param SquadRepository $squadRepository
     * @param SquadService $squadService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private SquadRepository $squadRepository,
        private SquadService $squadService
    )
    {
        $model = new Squad();
        $this->baseRepository->init($model);
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $squads = $this->baseRepository->getAll();
        $squads = $this->squadService->setPlural($squads);
        return JsonOutputFaced::setData($squads)->response();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $squads = $this->squadRepository->getFiltered($search);
        return JsonOutputFaced::setData($squads)->response();
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $employees = $request->get('employees');
        $squad = $this->baseRepository->store($request->validated());
        $this->squadRepository->sync($squad, $employees);

        return JsonOutputFaced::setMessage(__('squad.store.message'))
            ->setData($squad)->response();
    }

    /**
     * @param Squad $squad
     * @return JsonResponse
     */
    public function show(Squad $squad): JsonResponse
    {
        $squad = $this->squadService->setSingle($squad);
        return JsonOutputFaced::setData($squad)->response();
    }

    /**
     * @param UpdateRequest $request
     * @param Squad $squad
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Squad $squad): JsonResponse
    {
        $employees = $request->get('employees');
        $this->squadRepository->sync($squad, $employees);
        $this->baseRepository->update($squad, $request->validated());
        return JsonOutputFaced::response();
    }

    /**
     * @param Squad $squad
     * @return JsonResponse
     */
    public function destroy(Squad $squad): JsonResponse
    {
        $this->baseRepository->destroy($squad);
        return JsonOutputFaced::response();
    }
}
