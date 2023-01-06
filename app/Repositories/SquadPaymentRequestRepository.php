<?php

namespace App\Repositories;

use App\Interfaces\SquadPaymentRequestInterface;
use App\Models\SquadPaymentRequest;
use Illuminate\Contracts\Pagination\Paginator;

class SquadPaymentRequestRepository implements SquadPaymentRequestInterface
{
    /**
     * @param SquadPaymentRequest $squadPaymentRequest
     */
    public function __construct(protected SquadPaymentRequest $squadPaymentRequest)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->squadPaymentRequest
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('start_date', 'ilike', "%{$search}%");
                $query->orWhere('end_date', 'ilike', "%{$search}%");
            })->with(['squad', 'contract'])
            ->paginate($perPage);
    }
}
