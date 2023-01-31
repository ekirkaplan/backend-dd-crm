<?php

namespace App\Http\Controllers;
use App\Facades\JsonOutputFaced;
use App\Http\Resources\ContractReportResource;
use App\Models\Contract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class ContractReportController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if ($request->get('contract_id') > 0){
            $contracts = Contract::find($request->get('contract_id'));
            $contracts = [new ContractReportResource($contracts)];

            return JsonOutputFaced::setData($contracts)->response();
        }else{
            $contracts = Contract::all();
            $contracts = ContractReportResource::collection($contracts);

            return JsonOutputFaced::setData($contracts)->response();
        }
    }
}
