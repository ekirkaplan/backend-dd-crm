<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\SquadContract\StoreRequest;
use App\Http\Requests\SquadContract\UpdateRequest;
use App\Models\SquadContract;
use App\Repositories\BaseRepository;
use App\Repositories\SquadContractRepository;
use App\Services\SquadContractService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SquadContractController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private SquadContractRepository $squadContractRepository, private SquadContractService $squadContractService)
    {
        $this->baseRepository->init(new SquadContract());
    }

    public function getAll(): JsonResponse
    {
        $squadContracts = $this->squadContractService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($squadContracts)->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->squadContractRepository->getFiltered($search))->response();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Kesim Ekibine İş Atandı')->response();
    }

    public function show(SquadContract $squadContract): JsonResponse
    {
        $squadContract = $this->squadContractService->setSingle($squadContract);

        return JsonOutputFaced::setData($squadContract)->response();
    }

    public function update(UpdateRequest $request, SquadContract $squadContract):JsonResponse
    {
        $this->baseRepository->update($squadContract, $request->validated());

        return JsonOutputFaced::setMessage('Kesim EKibi İş Kaydı Düzenlendi')->response();
    }

    public function destroy(SquadContract $squadContract): JsonResponse
    {
        $this->baseRepository->destroy($squadContract);

        return JsonOutputFaced::setMessage('Kesim Ekibi İŞ Ataması Silindi')->response();
    }
}
