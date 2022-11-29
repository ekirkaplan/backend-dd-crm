<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = "employees";

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    public function squads()
    {
        return $this->belongsToMany(Squad::class, 'squad_employees');
    }
}
