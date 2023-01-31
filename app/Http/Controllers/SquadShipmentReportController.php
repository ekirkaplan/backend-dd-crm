<?php

namespace App\Http\Controllers;

use App\Models\SquadContract;
use Illuminate\Http\Request;

class SquadShipmentReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $a = SquadContract::all();
    }
}
,
