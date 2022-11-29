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
}
