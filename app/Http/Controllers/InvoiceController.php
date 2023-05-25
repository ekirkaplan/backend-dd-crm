<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Resources\ContractResource;
use App\Http\Resources\ContractShipmentResource;
use App\Http\Resources\CustomerShipmentResource;
use App\Models\ContractShipment;
use App\Models\CustomerShipment;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function getFiltered(Request $request)
    {
        $filtredParams = [
            'date' => $request->get('date'),
            'plate' => $request->get('plate'),
            'invoiceStatus' => $request->get('invoiceStatus')
        ];

        $customerShipments = CustomerShipment::query();
        $contractShipments = ContractShipment::query();

        $customerShipments->whereNull('product_invoice_no');
        $contractShipments->whereNull('invoice_no');

        if ($request->has('date')) {
            $customerShipments->where('shipment_date', $filtredParams['date']);
            $contractShipments->where('arrival_date', $filtredParams['date']);
        }

        if ($filtredParams['plate']) {
            $customerShipments->whereHas('shipment', function ($query) use ($filtredParams) {
                $query->where('vehicle_plate', 'ilike', "%{$filtredParams['plate']}%");
            });

            $contractShipments->whereHas('shipment', function ($query) use ($filtredParams) {
                $query->where('vehicle_plate', 'ilike', "%{$filtredParams['plate']}%");
            });
        }
        $customerShipments = $customerShipments->get();
        $contractShipments = $contractShipments->get();

        $returnData = [
            'contractData' => ContractShipmentResource::collection($contractShipments),
            'customerData' => CustomerShipmentResource::collection($customerShipments)
        ];

        return JsonOutputFaced::setData($returnData)->response();

    }

    public function getSupplier(Request $request)
    {
        $filtredParams = [
            'date' => $request->get('date'),
            'plate' => $request->get('plate'),
            'invoiceStatus' => $request->get('invoiceStatus')
        ];

        $customerShipments = CustomerShipment::query();

        $customerShipments->whereNull('supplier_purchase_invoice_no');

        if ($request->has('date')) {
            $customerShipments->where('shipment_date', $filtredParams['date']);
        }

        if ($filtredParams['plate']) {
            $customerShipments->whereHas('shipment', function ($query) use ($filtredParams) {
                $query->where('vehicle_plate', 'ilike', "%{$filtredParams['plate']}%");
            });
        }
        $customerShipments = $customerShipments->get();

        $returnData = [
            'customerData' => CustomerShipmentResource::collection($customerShipments)
        ];

        return JsonOutputFaced::setData($returnData)->response();

    }

    public function getShipment(Request $request)
    {
        $filtredParams = [
            'date' => $request->get('date'),
            'plate' => $request->get('plate'),
            'invoiceStatus' => $request->get('invoiceStatus')
        ];

        $customerShipments = CustomerShipment::query();
        $contractShipments = ContractShipment::query();

        $customerShipments->whereNull('shipment_invoice_no');
        $contractShipments->whereNull('shipment_invoice_no');

        if ($request->has('date')) {
            $customerShipments->where('shipment_date', $filtredParams['date']);
            $contractShipments->where('arrival_date', $filtredParams['date']);
        }

        if ($filtredParams['plate']) {
            $customerShipments->whereHas('shipment', function ($query) use ($filtredParams) {
                $query->where('vehicle_plate', 'ilike', "%{$filtredParams['plate']}%");
            });

            $contractShipments->whereHas('shipment', function ($query) use ($filtredParams) {
                $query->where('vehicle_plate', 'ilike', "%{$filtredParams['plate']}%");
            });
        }
        $customerShipments = $customerShipments->get();
        $contractShipments = $contractShipments->get();

        $returnData = [
            'contractData' => ContractShipmentResource::collection($contractShipments),
            'customerData' => CustomerShipmentResource::collection($customerShipments)
        ];

        return JsonOutputFaced::setData($returnData)->response();

    }
}
