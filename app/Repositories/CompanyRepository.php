<?php

namespace App\Repositories;

use App\Interfaces\CompanyInterface;
use App\Models\Company;
use Illuminate\Contracts\Pagination\Paginator;

class CompanyRepository implements CompanyInterface
{
    /**
     * @param Company $company
     */
    public function __construct(protected Company $company)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->company
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }

}
