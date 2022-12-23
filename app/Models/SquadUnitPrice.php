<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SquadUnitPrice extends Model
{
    use SoftDeletes;

    protected $table = 'squad_unit_prices';
    protected $guarded = ['id'];

    public function squad(): BelongsTo
    {
        return $this->belongsTo(Squad::class);
    }
}
