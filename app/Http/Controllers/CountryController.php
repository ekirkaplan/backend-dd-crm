<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Requests\Country\UpdateRequest;
use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Repositories\CountryRepository;
use App\Services\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param CountryRepository $countryRepository
     * @param CountryService $countryService
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private CountryRepository $countryRepository,
        private CountryService $countryService
    )
    {
        $this->baseRepository->init(new Country());
    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        $countries = $this->baseRepository->getAll();
        $countries = $this->countryService->setPlural($countries);
        return JsonOutputFaced::setData($countries)->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $countries = $this->countryRepository->getFiltered($search);
        return JsonOutputFaced::setData($countries)->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->baseRepository->store($request->validated());
        return JsonOutputFaced::response();
    }

    /**
     * @param  Country  $country
     * @return JsonResponse
     */
    public function show(Country $country): JsonResponse
    {
        $country = $this->countryService->setSingle($country);
        return JsonOutputFaced::setData($country)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Country  $country
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Country $country): JsonResponse
    {
        $this->baseRepository->update($country, $request->validated());
        return JsonOutputFaced::response();
    }

    /**
     * @param  Country  $country
     * @return JsonResponse
     */
    public function destroy(Country $country): JsonResponse
    {
        $this->baseRepository->destroy($country);
        return JsonOutputFaced::response();
    }
}
