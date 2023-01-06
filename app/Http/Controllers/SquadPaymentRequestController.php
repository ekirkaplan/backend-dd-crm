<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\SquadPaymentRequest\StoreRequest;
use App\Http\Requests\SquadPaymentRequest\UpdateRequest;
use App\Models\SquadPaymentRequest;
use App\Repositories\BaseRepository;
use App\Repositories\SquadPaymentRequestRepository;
use App\Services\SquadPaymentRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SquadPaymentRequestController extends Controller
{
    public function __construct(
        private BaseRepository $baseRepository,
        private SquadPaymentRequestRepository $squadPaymentRequestRepository,
        private SquadPaymentRequestService $squadPaymentRequestService
    ) {
        $this->baseRepository->init(new SquadPaymentRequest());
    }

    public function getAll(): JsonResponse
    {
        $squadPaymentRequest = $this->squadPaymentRequestService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($squadPaymentRequest)->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->squadPaymentRequestRepository->getFiltered($search))->response();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Ödeme Talebi Oluşturuldu')->response();
    }

    public function show(SquadPaymentRequest $squadPaymentRequest): JsonResponse
    {
        $squadPaymentRequest = $this->squadPaymentRequestService->setSingle($squadPaymentRequest);

        return JsonOutputFaced::setData($squadPaymentRequest)->response();
    }

    public function update(UpdateRequest $request, SquadPaymentRequest $squadPaymentRequest): JsonResponse
    {
        $this->baseRepository->update($squadPaymentRequest, $request->validated());

        return JsonOutputFaced::setMessage('Ödeme Talebi Kayıt Edildi')->response();
    }

    public function destroy(SquadPaymentRequest $squadPaymentRequest)
    {
        $this->baseRepository->destroy($squadPaymentRequest);

        return JsonOutputFaced::setMessage('Ödeme Talebi Kayıt Silindi')->response();
    }
}
