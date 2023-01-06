<?php

namespace App\Interfaces;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Collection;

interface ContractShipmentInterface extends FilteredInterface
{
    /**
     * @param Contract $contract
     * @return Collection
     */
    public function getGroupByContractId(Contract $contract): Collection;
}
