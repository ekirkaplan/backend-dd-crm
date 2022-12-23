<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        return $this->belongsToMany(Squad::class, 'squad_employees')->withTimestamps();
    }

    /**
     * @return HasOne
     */
    public function squadOfForeman(): HasOne
    {
        return $this->hasOne(Squad::class, 'foreman_id');
    }

    public function employeeSquads(): BelongsToMany
    {
        return $this->hasMany(SquadEmployee::class, 'employee_id')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
