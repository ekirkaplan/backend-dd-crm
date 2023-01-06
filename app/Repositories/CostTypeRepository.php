<?php

namespace App\Repositories;

use App\Interfaces\CostTypeInterface;
use App\Models\CostType;

class CostTypeRepository implements CostTypeInterface
{
    /**
     * @param CostType $costType
     */
    public function __construct(protected CostType $costType)
    {
    }
}
