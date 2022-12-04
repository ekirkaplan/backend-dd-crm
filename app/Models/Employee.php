<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes, HasActivity;

    /**
     * @var string
     */
    protected $table = "employees";

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsToMany
     */
    public function squads(): BelongsToMany
    {
        return $this->belongsToMany(Squad::class, 'squad_employees');
    }
}
