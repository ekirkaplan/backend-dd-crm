<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Contracts\StoreRequest;
use App\Http\Requests\Contracts\UpdateRequest;
use App\Models\Contract;
use App\Repositories\ContractRepository;
use App\Repositories\MediaRepository;
use App\Services\ContractService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * @param ContractRepository $contractRepository
     * @param ContractService $contractService
     */
    public function __construct(private ContractRepository $contractRepository, private ContractService $contractService, private MediaRepository $mediaRepository)
    {
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $contracts = $this->contractService->setPlural($this->contractRepository->getAll());
        return JsonOutputFaced::setData($contracts)->response();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->contractRepository->getFiltered($search))->response();
    }

    /**
     * @return JsonResponse
     */
    public function getArchived(): JsonResponse
    {
        $contracts = $this->contractRepository->getArchived();
        return JsonOutputFaced::setData($contracts)->response();
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $contract = $this->contractRepository->store($request->validated());
        $mediasData = [
            'model_type' => Contract::class,
            'model_id' => $contract->id,
            'files' => $request->get('files'),
        ];
        $this->mediaRepository->sync($mediasData);

        return JsonOutputFaced::setMessage('Kesim Sözleşmesi Oluşturuldu')->response();
    }

    /**
     * @param Contract $contract
     * @return JsonResponse
     */
    public function show(Contract $contract): JsonResponse
    {
        $contract = $this->contractService->setSingle($contract);

        return JsonOutputFaced::setData($contract)->response();
    }

    /**
     * @param UpdateRequest $request
     * @param Contract $contract
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Contract $contract): JsonResponse
    {
        $this->contractRepository->update($contract, $request->validated());

        $mediasData = [
            'model_type' => Contract::class,
            'model_id' => $contract->id,
            'files' => $request->get('files'),
        ];
        $this->mediaRepository->sync($mediasData);
        return JsonOutputFaced::setMessage('Kesim Sözleşmesi Güncellendi')->response();
    }

    /**
     * @param Contract $contract
     * @return JsonResponse
     */
    public function destroy(Contract $contract): JsonResponse
    {
        $this->contractRepository->destroy($contract);

        return JsonOutputFaced::setMessage('Kesim Sözleşmesi Silindi')->response();
    }
}
