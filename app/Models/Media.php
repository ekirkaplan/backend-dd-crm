<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes, HasActivity;

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    protected $table = 'medias';

    /**
     * @var string[]
     */
    protected $cast = ['path'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'extension',
        'full_name',
        'mime_class',
        'mime_type',
        'size',
    ];

    /**
     * @return Model|MorphTo
     */
    public function model(): Model|MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return url('api/media', $this->id);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->url();
    }

    /**
     * @return Attribute|string
     */
    public function path(): Attribute|string
    {
        return 'medias/' . $this->full_name;
    }
}
