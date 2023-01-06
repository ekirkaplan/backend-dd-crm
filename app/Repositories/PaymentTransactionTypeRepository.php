<?php

namespace App\Repositories;

use App\Interfaces\PaymentTransactionTypeInterface;
use App\Models\PaymentTransactionType;

class PaymentTransactionTypeRepository implements PaymentTransactionTypeInterface
{
    /**
     * @param PaymentTransactionType $paymentTransactionType
     */
    public function __construct(protected PaymentTransactionType $paymentTransactionType)
    {
    }
}
