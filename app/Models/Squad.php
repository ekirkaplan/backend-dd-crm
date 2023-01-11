<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $this->belongsToMany(Employee::class, 'squad_employees')->whereNull('squad_employees.end_date');
    }

    /**
     * @return HasMany
     */
    public function squadEmployees(): HasMany
    {
        return $this->hasMany(SquadEmployee::class, 'squad_id')->whereNull('end_date')->with('employee');
    }

    /**
     * @return BelongsTo
     */
    public function foreman(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'foreman_id');
    }

    /**
     * @return HasMany
     */
    public function unitPrices(): HasMany
    {
        return $this->hasMany(SquadUnitPrice::class);
    }
}
