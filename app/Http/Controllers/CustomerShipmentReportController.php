<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Repositories\CustomerShipmentReportRepository;
use App\Services\CustomerShipmentReportService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerShipmentReportController extends Controller
{
    public function __construct(
        private CustomerShipmentReportService $customerShipmentReportService,
        private CustomerShipmentReportRepository $customerShipmentReportRepository
    ) {
    }

    public function getReport(Request $request): JsonResponse
    {
        $filter = [
            'start_date' => $request->get('start_date') ?? now()->previousWeekday(),
            'end_date' => $request->get('end_date') ?? now(),
            'plate' => $request->get('plate'),
            'customer_id' => $request->get('customer_id'),
        ];

        $report = $this->customerShipmentReportRepository->getReport($filter);

        $report = $this->customerShipmentReportService->setPlural($report);

        return JsonOutputFaced::setData($report)->response();
    }
}
