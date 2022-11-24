<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\Paginator;

interface FilteredInterface
{
    /**
     * @param string|null $search
     * @param int $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator;
}
