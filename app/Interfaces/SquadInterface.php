<?php

namespace App\Interfaces;

use App\Models\Squad;

interface SquadInterface extends FilteredInterface
{
    /**
     * @param  Squad  $squad
     * @param  array  $data
     * @return void
     */
    public function sync(Squad $squad, array $data): void;

    /**
     * @param  Squad  $squad
     * @param  array  $employees
     * @param  array  $removedEmployees
     * @return void
     */
    public function syncUpdate(Squad $squad, array $employees, array $removedEmployees): void;
}
