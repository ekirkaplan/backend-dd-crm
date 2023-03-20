<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Resources\SquadShipmentReportResource;
use App\Models\SquadContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SquadShipmentReportController extends Controller
{
    public function getReport(Request $request): JsonResponse
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $a = SquadContract::where('start_date', '>=', $startDate)
            ->where('end_date', '<=', $endDate)->get();

        $report = SquadShipmentReportResource::collection($a);

        return JsonOutputFaced::setData($report)->response();

    }
}
