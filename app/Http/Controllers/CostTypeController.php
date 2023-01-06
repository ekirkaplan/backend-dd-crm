<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Models\CostType;
use App\Repositories\BaseRepository;
use App\Services\CostTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CostTypeController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private CostTypeService $costTypeService)
    {
        $this->baseRepository->init(new CostType());
    }

    public function getAll(): JsonResponse
    {
        $costTypes = $this->costTypeService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($costTypes)->response();
    }

    public function store(Request $request)
    {
    }

    public function show(CostType $costType): JsonResponse
    {
        $costType = $this->costTypeService->setSingle($costType);

        return JsonOutputFaced::setData($costType)->response();
    }

    public function update(Request $request, CostType $costType)
    {
    }

    public function destroy(CostType $costType)
    {
    }
}
