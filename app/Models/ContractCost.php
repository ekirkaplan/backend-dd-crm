<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractCost extends Model
{
    use SoftDeletes, HasActivity;

    /**
     * @var string
     */
    protected $table = 'contract_costs';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class)->with('chiefDirector');
    }

    /**
     * @return BelongsTo
     */
    public function costType(): BelongsTo
    {
        return $this->belongsTo(CostType::class);
    }

    /**
     * @return BelongsTo
     */
    public function squad(): BelongsTo
    {
        return $this->belongsTo(Squad::class);
    }

}
