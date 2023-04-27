<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SquadUnitPrice extends Model
{
    use SoftDeletes, HasActivity;

    protected $table = 'squad_unit_prices';
    protected $guarded = ['id'];

    public function squad(): BelongsTo
    {
        return $this->belongsTo(Squad::class)->with('foreman');
    }
}
