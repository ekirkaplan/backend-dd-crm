<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface EmployeeInterface extends FilteredInterface
{

    /**
     * @return Collection
     */
    public function outOfSquadEmployee(): Collection;

    /**
     * @return Collection
     */
    public function outOfSquadForeman(): Collection;
}
