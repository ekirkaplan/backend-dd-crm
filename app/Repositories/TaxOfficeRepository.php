<?php

namespace App\Repositories;

use App\Interfaces\TaxOfficeInterface;
use App\Models\TaxOffice;
use Illuminate\Contracts\Pagination\Paginator;

class TaxOfficeRepository implements TaxOfficeInterface
{
    /**
     * @param TaxOffice $taxOffice
     */
    public function __construct(protected TaxOffice $taxOffice)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->taxOffice
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->paginate($perPage);
    }
}
