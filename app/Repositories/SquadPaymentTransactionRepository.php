<?php

namespace App\Repositories;

use App\Interfaces\SquadPaymentTransactionInterface;
use App\Models\Contract;
use App\Models\Squad;
use App\Models\SquadContract;
use App\Models\SquadPaymentTransaction;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class SquadPaymentTransactionRepository implements SquadPaymentTransactionInterface
{
    /**
     * @param  SquadPaymentTransaction  $squadPaymentTransaction
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

    public function getTotalTransactionAmount(Squad $squad, Contract $contract): float
    {
        $shipmentsRawSql = DB::raw("select sum(squad_calc_amount) AS squad_calc_amount from contract_shipments WHERE squad_id = {$squad->id} AND contract_id = {$contract->id};");
        $shipmentsSelect = DB::select($shipmentsRawSql);

        $transactionsRawSql = DB::raw("select sum(payment_amount) AS total_payment_amount from squad_payment_transactions WHERE squad_id = {$squad->id} AND contract_id = {$contract->id};");
        $transactionsSelect = DB::select($transactionsRawSql);

        return (double)$shipmentsSelect[0]->squad_calc_amount - (double)$transactionsSelect[0]->total_payment_amount;
    }
}
