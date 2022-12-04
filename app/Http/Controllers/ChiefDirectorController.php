<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\ChiefDirector\StoreRequest;
use App\Http\Requests\ChiefDirector\UpdateRequest;
use App\Models\ChiefDirector;
use App\Repositories\BaseRepository;
use App\Repositories\ChiefDirectorRepository;
use App\Services\ChiefDirectorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChiefDirectorController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param ChiefDirectorRepository $chiefDirectorRepository
     * @param ChiefDirectorService $chiefDirectorService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private ChiefDirectorRepository $chiefDirectorRepository,
        private ChiefDirectorService $chiefDirectorService
    )
    {
        $this->baseRepository->init(new ChiefDirector());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $chiefDirectors = $this->baseRepository->getAll();
        $chiefDirectors = $this->chiefDirectorService->setPlural($chiefDirectors);
        return JsonOutputFaced::setData($chiefDirectors)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $chiefDirectors = $this->chiefDirectorRepository->getFiltered($search);
        return JsonOutputFaced::setData($chiefDirectors)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::setMessage('İşletme Müdürlüğü Eklendi')->response();
    }

    /**
     * @param  ChiefDirector  $chiefDirector
     * @return JsonResponse
     */
    public function show(ChiefDirector $chiefDirector): JsonResponse
    {
        $chiefDirector = $this->chiefDirectorService->setSingle($chiefDirector);
        return JsonOutputFaced::setData($chiefDirector)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  ChiefDirector  $chiefDirector
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ChiefDirector $chiefDirector): JsonResponse
    {
        $this->baseRepository->update($chiefDirector, $request->validated());
        return JsonOutputFaced::setMessage('İşletme Müdürlüğü Güncellendi')->response();
    }

    /**
     * @param  ChiefDirector  $chiefDirector
     * @return JsonResponse
     */
    public function destroy(ChiefDirector $chiefDirector): JsonResponse
    {
        $this->baseRepository->destroy($chiefDirector);
        return JsonOutputFaced::setMessage('İşletme Müdürlüğü Silidi')->response();
    }
}
