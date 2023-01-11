<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SquadPaymentRequest extends Model
{
    protected $table = 'squad_payment_requests';
    protected $guarded = ['id'];


    public function squad(): BelongsTo
    {
        return $this->belongsTo(Squad::class)->with('foreman');
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}
