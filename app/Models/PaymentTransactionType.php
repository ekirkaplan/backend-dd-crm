<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransactionType extends Model
{
    /**
     * @var string
     */
    protected $table = 'payment_transaction_types';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
}
