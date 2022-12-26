<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SquadContract extends Model
{
    use SoftDeletes;

    protected $table = 'squad_contracts';
    protected $guarded = ['id'];

    public function squad(): BelongsTo
    {
        return $this->belongsTo(Squad::class)->with('foreman');
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}
