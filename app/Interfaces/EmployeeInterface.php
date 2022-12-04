<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface EmployeeInterface extends FilteredInterface
{

    /**
     * @return Collection
     */
    public function outOfSquad(): Collection;
}
