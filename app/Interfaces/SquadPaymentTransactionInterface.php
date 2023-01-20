<?php

namespace App\Interfaces;

use App\Models\Contract;
use App\Models\Squad;

interface SquadPaymentTransactionInterface extends FilteredInterface
{
    /**
     * @param  Squad  $squad
     * @param  Contract  $contract
     * @return float
     */
    public function getTotalTransactionAmount(Squad $squad, Contract $contract): float;
}
