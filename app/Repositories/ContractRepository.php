<?php

namespace App\Repositories;

use App\Interfaces\ContractInterface;
use App\Models\Contract;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class ContractRepository implements ContractInterface
{
    /**
     * @param Contract $contract
     */
    public function __construct(protected Contract $contract)
    {
    }


    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->contract->query()->get();
    }

    /**
     * @param string|null $search
     * @param int $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->contract
            ->query()
            ->where('archived', 0)
            ->when($search, function ($query, $search) {
                $query->orWhere('stack_no', 'ilike', "%{$search}%");
                $query->orWhere('parcel_no', 'ilike', "%{$search}%");
                $query->orWhere('cubic_meter', 'ilike', "%{$search}%");
                $query->orWhere('forward_sale_price', 'ilike', "%{$search}%");
                $query->orWhere('contract_stamp_duty', 'ilike', "%{$search}%");
                $query->orWhere('contract_invoice_date', 'ilike', "%{$search}%");
            })->with(['chiefDirector', 'regionDirector', 'exitWarehouse', 'productType'])
            ->paginate($perPage);
    }

    /**
     * @param string|null $search
     * @param int $perPage
     * @return Paginator
     */
    public function getArchived(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->contract
            ->query()
            ->where('archived', 1)
            ->when($search, function ($query, $search) {
                $query->orWhere('stack_no', 'ilike', "%{$search}%");
                $query->orWhere('parcel_no', 'ilike', "%{$search}%");
                $query->orWhere('cubic_meter', 'ilike', "%{$search}%");
                $query->orWhere('forward_sale_price', 'ilike', "%{$search}%");
                $query->orWhere('contract_stamp_duty', 'ilike', "%{$search}%");
                $query->orWhere('contract_invoice_date', 'ilike', "%{$search}%");
            })->with(['chiefDirector', 'regionDirector', 'exitWarehouse', 'productType'])
            ->paginate($perPage);
    }

    /**
     * @param Contract $contract
     * @return Contract
     */
    public function show(Contract $contract): Contract
    {
        return $contract;
    }

    /**
     * @param array $data
     * @return Contract
     */
    public function store(array $data): Contract
    {
        return $this->contract->query()->create($data);
    }

    /**
     * @param array $data
     * @param Contract $contract
     * @return Contract
     */
    public function update(Contract $contract, array $data): Contract
    {
        $contract->update($data);
        return $contract;
    }

    /**
     * @param Contract $contract
     * @return bool
     */
    public function destroy(Contract $contract): bool
    {
        return $contract->update(['archived' => 1]);
    }
}
