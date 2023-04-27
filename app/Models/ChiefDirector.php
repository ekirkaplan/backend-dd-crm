<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiefDirector extends Model
{
    use SoftDeletes, HasActivity;

    /**
     * @var string
     */
    protected $table = 'chief_directors';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function regionDirector(): BelongsTo
    {
        return $this->belongsTo(RegionDirector::class, 'region_director_id');
    }
}
