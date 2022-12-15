<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Drivers\StoreRequest;
use App\Http\Requests\Drivers\UpdateRequest;
use App\Models\Driver;
use App\Repositories\BaseRepository;
use App\Repositories\DriverRepository;
use App\Services\DriverService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private DriverRepository $driverRepository, private DriverService $driverService)
    {
        $this->baseRepository->init(new Driver());
    }

    public function getAll(): JsonResponse
    {
        $drivers = $this->driverService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($drivers)->response();
    }

    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->driverRepository->getFiltered($search))->response();
    }

    public function store(StoreRequest $request)
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Sürücü Oluşturuldu')->response();
    }

    public function show(Driver $driver): JsonResponse
    {
        $driver = $this->driverService->setSingle($driver);

        return JsonOutputFaced::setData($driver)->response();
    }

    public function update(UpdateRequest $request, Driver $driver): JsonResponse
    {
        $this->baseRepository->update($driver, $request->validated());

        return JsonOutputFaced::setMessage('Sürücü Güncellendi')->response();
    }

    public function destroy(Driver $driver): JsonResponse
    {
        $this->baseRepository->destroy($driver);

        return JsonOutputFaced::setMessage('Sürücü Silindi')->response();
    }
}
