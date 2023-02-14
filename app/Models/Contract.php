<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'contracts';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function chiefDirector(): BelongsTo
    {
        return $this->belongsTo(ChiefDirector::class, 'chief_director_id');
    }

    /**
     * @return BelongsTo
     */
    public function chiefdom(): BelongsTo
    {
        return $this->belongsTo(Chiefdom::class);
    }

    /**
     * @return BelongsTo
     */
    public function regionDirector(): BelongsTo
    {
        return $this->belongsTo(RegionDirector::class);
    }

    /**
     * @return BelongsTo
     */
    public function exitWarehouse(): BelongsTo
    {
        return $this->belongsTo(ExitWarehouse::class);
    }

    /**
     * @return BelongsTo
     */
    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function medias(): MorphToMany
    {
        return $this->morphToMany(Media::class, 'model', 'model_has_media');
    }
}
