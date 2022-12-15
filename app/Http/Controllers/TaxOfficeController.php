<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\TaxOffice\StoreRequest;
use App\Http\Requests\TaxOffice\UpdateRequest;
use App\Models\TaxOffice;
use App\Repositories\BaseRepository;
use App\Repositories\TaxOfficeRepository;
use App\Services\TaxOfficeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaxOfficeController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private TaxOfficeRepository $taxOfficeRepository, private TaxOfficeService $taxOfficeService)
    {
        $this->baseRepository->init(new TaxOffice());
    }

    public function getAll(): JsonResponse
    {
        $taxOffices = $this->taxOfficeService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($taxOffices)->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->taxOfficeRepository->getFiltered($search))->response();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Vergi Dairesi Eklendi')->response();
    }

    public function show(TaxOffice $taxOffice): JsonResponse
    {
        $taxOffice = $this->taxOfficeService->setSingle($taxOffice);

        return JsonOutputFaced::setData($taxOffice)->response();
    }

    public function update(UpdateRequest $request, TaxOffice $taxOffice): JsonResponse
    {
        $this->baseRepository->update($taxOffice, $request->validated());

        return JsonOutputFaced::setMessage('Vergi Dairesi Güncellendi')->response();
    }

    public function destroy(TaxOffice $taxOffice): JsonResponse
    {
        $this->baseRepository->destroy($taxOffice);

        return JsonOutputFaced::setMessage('Vergi Dairesi Silindi')->response();
    }
}
