<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Contracts\StoreRequest;
use App\Http\Requests\Contracts\UpdateRequest;
use App\Models\Contract;
use App\Repositories\BaseRepository;
use App\Repositories\ContractRepository;
use App\Services\ContractService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private ContractRepository $contractRepository, private ContractService $contractService)
    {
        $this->baseRepository->init(new Contract());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $contracts = $this->contractService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($contracts)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->contractRepository->getFiltered($search))->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Kesim Sözleşmesi Oluşturuldu')->response();
    }

    /**
     * @param  Contract  $contract
     * @return JsonResponse
     */
    public function show(Contract $contract): JsonResponse
    {
        $contract = $this->contractService->setSingle($contract);

        return JsonOutputFaced::setData($contract)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Contract  $contract
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Contract $contract): JsonResponse
    {
        $this->baseRepository->update($contract, $request->validated());

        return JsonOutputFaced::setMessage('Kesim Sözleşmesi Güncellendi')->response();
    }

    /**
     * @param  Contract  $contract
     * @return JsonResponse
     */
    public function destroy(Contract $contract): JsonResponse
    {
        $this->baseRepository->destroy($contract);

        return JsonOutputFaced::setMessage('Kesim Sözleşmesi Silindi')->response();
    }
}
