<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class SquadPaymentTransaction extends Model
{
    /**
     * @var string
     */
    protected $table = 'squad_payment_transactions';
    /**
     * @var array
     */
    protected $guarded = [];

    protected $appends = ['total_transaction_amount','total_payment_amount'];

    /**
     * @return BelongsTo
     */
    public function squad(): BelongsTo
    {
        return $this->belongsTo(Squad::class)->with('foreman');
    }

    /**
     * @return BelongsTo
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * @return BelongsTo
     */
    public function paymentTransactionType(): BelongsTo
    {
        return $this->belongsTo(PaymentTransactionType::class);
    }


    protected function getTotalTransactionAmountAttribute(): float
    {

        $shipmentsRawSql = DB::raw("select sum(squad_calc_amount) AS squad_calc_amount from contract_shipments WHERE squad_id = {$this->squad_id} AND contract_id = {$this->contract_id};");
        $shipmentsSelect = DB::select($shipmentsRawSql);

        $transactionsRawSql = DB::raw("select sum(payment_amount) AS total_payment_amount from squad_payment_transactions WHERE squad_id = {$this->squad_id} AND contract_id = {$this->contract_id};");
        $transactionsSelect = DB::select($transactionsRawSql);

        return (double)$shipmentsSelect[0]->squad_calc_amount - (double)$transactionsSelect[0]->total_payment_amount;
    }

    protected function getTotalPaymentAmountAttribute(): float
    {
        $transactionsRawSql = DB::raw("select sum(payment_amount) AS total_payment_amount from squad_payment_transactions WHERE squad_id = {$this->squad_id} AND contract_id = {$this->contract_id};");
        $transactionsSelect = DB::select($transactionsRawSql);

        return $transactionsSelect[0]->total_payment_amount;
    }
}
