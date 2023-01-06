<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * @return BelongsTo
     */
    public function squad(): BelongsTo
    {
        return $this->belongsTo(Squad::class);
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
}
