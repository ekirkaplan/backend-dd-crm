<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiefDirectore extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'chief_directores';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function regionDirectore(): BelongsTo
    {
        return $this->belongsTo(RegionDirectore::class, 'region_directore_id');
    }
}
