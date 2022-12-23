<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chiefdom extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'chiefdoms';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function chiefDirector(): BelongsTo
    {
        return $this->belongsTo(ChiefDirector::class);
    }
}
