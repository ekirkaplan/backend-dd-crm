<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Requests\Country\UpdateRequest;
use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Repositories\CountryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * @param  BaseRepository  $baseRepository
     * @param  CountryRepository  $countryRepository
     */
    public function __construct(private BaseRepository $baseRepository, private CountryRepository $countryRepository)
    {
        $this->baseRepository->init(new Country());
    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->getAll())->response();
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');

        return JsonOutputFaced::setData($this->countryRepository->getFiltered($search))->response();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->store($request->validated()))->response();
    }

    /**
     * @param  Country  $country
     * @return JsonResponse
     */
    public function show(Country $country): JsonResponse
    {
        return JsonOutputFaced::setData($country)->response();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Country  $country
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Country $country): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->update($country, $request->validated()))->response();
    }

    /**
     * @param  Country  $country
     * @return JsonResponse
     */
    public function destroy(Country $country): JsonResponse
    {
        return JsonOutputFaced::setData($this->baseRepository->destroy($country))->response();
    }
}
