<?php

namespace App\Services;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyService
{
    /**
     * @param Company $company
     * @return CompanyResource
     */
    public function setSingle(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * @param Collection $companies
     * @return JsonResource
     */
    public function setPlural(Collection $companies): JsonResource
    {
        return CompanyResource::collection($companies);
    }
}
