<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Squad\StoreRequest;
use App\Http\Requests\Squad\UpdateRequest;
use App\Models\Squad;
use App\Repositories\BaseRepository;
use App\Repositories\SquadRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SquadController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private SquadRepository $squadRepository)
    {
        $model = new Squad();
        $this->baseRepository->init($model);
    }

    public function getAll(): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->getAll())->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->squadRepository->getFiltered($search))->response();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $employees = $request->get('employees');
        $squad = $this->baseRepository->store($request->validated());
        $this->squadRepository->sync($squad, $employees);

        return JsonOutputFaced::setMessage(__('squad.store.message'))
            ->setData($squad)->response();
    }

    public function show(Squad $squad): JsonResponse
    {
        return JsonOutputFaced::setData($squad)->response();
    }

    public function update(UpdateRequest $request, Squad $squad): JsonResponse
    {
        $employees = $request->get('employees');
        $this->squadRepository->sync($squad, $employees);

        return JsonOutputFaced::setData($this->baseRepository->update($squad, $request->validated()))->response();
    }

    public function destroy(Squad $squad): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($squad))->response();
    }
}
