<?php

namespace App\Repositories;

use App\Interfaces\SquadPaymentTransactionInterface;
use App\Models\SquadPaymentTransaction;
use Illuminate\Contracts\Pagination\Paginator;

class SquadPaymentTransactionRepository implements SquadPaymentTransactionInterface
{
    /**
     * @param SquadPaymentTransaction $squadPaymentTransaction
     */
    public function __construct(protected SquadPaymentTransaction $squadPaymentTransaction)
    {
    }

    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->squadPaymentTransaction
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('total_transaction_amount', 'ilike', "%{$search}%");
                $query->orWhere('total_payment_amount', 'ilike', "%{$search}%");
                $query->orWhere('payment_date', 'ilike', "%{$search}%");
                $query->orWhere('payment_amount', 'ilike', "%{$search}%");
            })->with(['squad', 'contract', 'paymentTransactionType'])
            ->paginate($perPage);
    }
}
