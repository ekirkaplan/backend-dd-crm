<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\SquadPaymentTransactions\StoreRequest;
use App\Http\Requests\SquadPaymentTransactions\UpdateRequest;
use App\Models\Contract;
use App\Models\Squad;
use App\Models\SquadPaymentTransaction;
use App\Repositories\BaseRepository;
use App\Repositories\SquadPaymentTransactionRepository;
use App\Services\SquadPaymentTransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SquadPaymentTransactionController extends Controller
{
    public function __construct(
        private BaseRepository $baseRepository,
        private SquadPaymentTransactionRepository $squadPaymentTransactionRepository,
        private SquadPaymentTransactionService $squadPaymentTransactionService
    ) {
        $this->baseRepository->init(new SquadPaymentTransaction());
    }

    public function getAll(): JsonResponse
    {
        $squadPaymentTransactions = $this->squadPaymentTransactionService
            ->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($squadPaymentTransactions)->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->squadPaymentTransactionRepository->getFiltered($search))
            ->response();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Kesim Ekibi Cari İşlem Kayıt Edildi')->response();
    }

    public function show(SquadPaymentTransaction $squadPaymentTransaction): JsonResponse
    {
        $squadPaymentTransaction = $this->squadPaymentTransactionService->setSingle($squadPaymentTransaction);

        return JsonOutputFaced::setData($squadPaymentTransaction)->response();
    }

    public function update(UpdateRequest $request, SquadPaymentTransaction $squadPaymentTransaction): JsonResponse
    {
        $this->baseRepository->update($squadPaymentTransaction, $request->validated());

        return JsonOutputFaced::setMessage('Kesim Ekibi Cari İşlem Düzenlendi')->response();
    }

    public function destroy(SquadPaymentTransaction $squadPaymentTransaction): JsonResponse
    {
        $this->baseRepository->destroy($squadPaymentTransaction);

        return JsonOutputFaced::setMessage('Kesim Ekibi Cari İşlemi Silindi')->response();
    }

    public function getTotalTransactionAmount(Squad $squad, Contract $contract): JsonResponse
    {
        $data = $this->squadPaymentTransactionRepository->getTotalTransactionAmount($squad, $contract);

        return JsonOutputFaced::setData($data)->response();
    }
}
