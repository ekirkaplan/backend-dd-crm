<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasActivity;

    protected $appends = ['url'];

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


    public function getUrlAttribute()
    {
        return url("/uploads/".$this->created_at->format('d_m_Y')."/".$this->full_name);
    }
}
