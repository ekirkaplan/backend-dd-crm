<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ActivityLog
 * @package App\Models
 * @property-read string $id
 * @property int $user_id
 * @property string $model
 * @property string $action
 * @property string $old_data
 * @property string $new_data
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class ActivityLog extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * Predefined
     */
    const UPDATED_AT = null;
    /**
     * @var string[]
     */
    public $timestamps = ['created_at'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'model',
        'action',
        'old_data',
        'new_data'
    ];

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
