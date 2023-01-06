<?php

namespace App\Interfaces;

use App\Models\Contract;
use Illuminate\Contracts\Pagination\Paginator;

interface ContractInterface extends FilteredInterface
{
    /**
     * @param Contract $contract
     * @return Contract
     */
    public function show(Contract $contract): Contract;

    /**
     * @param array $data
     * @return Contract
     */
    public function store(array $data): Contract;

    /**
     * @param Contract $contract
     * @param array $data
     * @return Contract
     */
    public function update(Contract $contract, array $data): Contract;

    /**
     * @param Contract $contract
     * @return bool
     */
    public function destroy(Contract $contract): bool;

    /**
     * @param string|null $search
     * @param int $perPage
     * @return Paginator
     */
    public function getArchived(?string $search = null, int $perPage = 10): Paginator;
}
