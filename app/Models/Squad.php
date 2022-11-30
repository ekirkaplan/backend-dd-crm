<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Squad extends Model
{
    use SoftDeletes, HasActivity;

    /**
     * @var string
     */
    protected $table = "squads";

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsToMany
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'squad_employees');
    }
}
