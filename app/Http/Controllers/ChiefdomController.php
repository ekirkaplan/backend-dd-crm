<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Chiefdom\StoreRequest;
use App\Http\Requests\Chiefdom\UpdateRequest;
use App\Models\ChiefDirector;
use App\Models\Chiefdom;
use App\Repositories\BaseRepository;
use App\Repositories\ChiefdomRepository;
use App\Services\ChiefdomService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChiefdomController extends Controller
{
    public function __construct(private BaseRepository $baseRepository, private ChiefdomRepository $chiefdomRepository, private ChiefdomService $chiefdomService)
    {
        $this->baseRepository->init(new Chiefdom());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $chiefdoms = $this->chiefdomService->setPlural($this->baseRepository->getAll());

        return JsonOutputFaced::setData($chiefdoms)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->chiefdomRepository->getFiltered($search))->response();
    }

    /**
     * @param  ChiefDirector  $chiefDirector
     * @return JsonResponse
     */
    public function getByChiefDirector(ChiefDirector $chiefDirector): JsonResponse
    {
        $chiefdoms = $this->chiefdomService->setPlural($this->chiefdomRepository->getByChiefDirector($chiefDirector));

        return JsonOutputFaced::setData($chiefdoms)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());

        return JsonOutputFaced::setMessage('Şeflik oluşturuldu')->response();
    }

    /**
     * @param  Chiefdom  $chiefdom
     * @return JsonResponse
     */
    public function show(Chiefdom $chiefdom): JsonResponse
    {
        return JsonOutputFaced::setData($this->chiefdomService->setSingle($chiefdom))->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Chiefdom  $chiefdom
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Chiefdom $chiefdom): JsonResponse
    {
        $this->baseRepository->update($chiefdom, $request->validated());

        return JsonOutputFaced::setMessage('Şeflik kayıt edildi')->response();
    }

    /**
     * @param  Chiefdom  $chiefdom
     * @return JsonResponse
     */
    public function destroy(Chiefdom $chiefdom): JsonResponse
    {
        $this->baseRepository->destroy($chiefdom);

        return JsonOutputFaced::setMessage('Şeflik Silindi')->response();
    }
}
