<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\SquadUnitPrices\StoreRequest;
use App\Http\Requests\SquadUnitPrices\UpdateRequest;
use App\Models\SquadUnitPrice;
use App\Repositories\BaseRepository;
use App\Repositories\SquadUnitPriceRepository;
use App\Services\SquadUnitPriceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SquadUnitPriceController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private SquadUnitPriceRepository $squadUnitPriceRepository, private SquadUnitPriceService $squadUnitPriceService)
    {
        $this->baseRepository->init(new SquadUnitPrice());
    }
    public function getAll(): JsonResponse
    {
        $squadUnitPrices = $this->squadUnitPriceService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($squadUnitPrices)->response();
    }
    public function getFiltered(Request $request): JsonResponse
    {
        $search =  $request->get('search');

        return JsonOutputFaced::setData($this->squadUnitPriceRepository->getFiltered($search))->response();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Birim Fiyat Oluşturuldu')->response();
    }

    public function show(SquadUnitPrice $squadUnitPrice): JsonResponse
    {
        $squadUnitPrice = $this->squadUnitPriceService->setSingle($squadUnitPrice);

        return JsonOutputFaced::setData($squadUnitPrice)->response();
    }

    public function update(UpdateRequest $request, SquadUnitPrice $squadUnitPrice): JsonResponse
    {
        $this->baseRepository->update($squadUnitPrice, $request->validated());

        return JsonOutputFaced::setMessage('Birim Fiyat Düzenlendi')->response();
    }

    public function destroy(SquadUnitPrice $squadUnitPrice): JsonResponse
    {
        $this->baseRepository->destroy($squadUnitPrice);

        return JsonOutputFaced::setMessage('Birim Fiyat Silindi')->response();
    }
}
