<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Vehicles\StoreRequest;
use App\Http\Requests\Vehicles\UpdateRequest;
use App\Models\Vehicle;
use App\Repositories\BaseRepository;
use App\Repositories\VehicleRepository;
use App\Services\VehicleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct(protected BaseRepository $baseRepository, protected VehicleRepository $vehicleRepository, protected VehicleService $vehicleService)
    {
        $this->baseRepository->init(new Vehicle());
    }

    public function getAll(): JsonResponse
    {
        $vehicles = $this->vehicleService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($vehicles)->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->vehicleRepository->getFiltered($search))->response();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Araç Eklendi')->response();
    }

    public function show(Vehicle $vehicle): JsonResponse
    {
        return JsonOutputFaced::setData($this->vehicleService->setSingle($vehicle))->response();
    }

    public function update(UpdateRequest $request, Vehicle $vehicle): JsonResponse
    {
        $this->baseRepository->update($vehicle, $request->validated());

        return JsonOutputFaced::setMessage('Araç Güncellendi')->response();
    }

    public function destroy(Vehicle $vehicle): JsonResponse
    {
        $this->baseRepository->destroy($vehicle);

        return JsonOutputFaced::setMessage('Araç Silindi')->response();
    }
}
