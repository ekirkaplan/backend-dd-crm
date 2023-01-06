<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Models\PaymentTransactionType;
use App\Repositories\BaseRepository;
use App\Services\PaymentTransactionTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentTransactionTypeController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  PaymentTransactionTypeService  $paymentTransactionTypeService
     */
    public function __construct(private BaseRepository $baseRepository, private PaymentTransactionTypeService $paymentTransactionTypeService)
    {
        $this->baseRepository->init(new PaymentTransactionType());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $paymentTransactionTypes = $this->paymentTransactionTypeService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($paymentTransactionTypes)->response();
    }

    /**
     * @param  Request  $request
     * @return void
     */
    public function store(Request $request)
    {
    }

    /**
     * @param  PaymentTransactionType  $paymentTransactionType
     * @return JsonResponse
     */
    public function show(PaymentTransactionType $paymentTransactionType): JsonResponse
    {
        $paymentTransactionType = $this->paymentTransactionTypeService->setSingle($paymentTransactionType);

        return JsonOutputFaced::setData($paymentTransactionType)->response();
    }

    /**
     * @param  Request  $request
     * @param  PaymentTransactionType  $paymentTransactionType
     * @return void
     */
    public function update(Request $request, PaymentTransactionType $paymentTransactionType)
    {
    }

    /**
     * @param  PaymentTransactionType  $paymentTransactionType
     * @return void
     */
    public function destroy(PaymentTransactionType $paymentTransactionType)
    {
    }
}
