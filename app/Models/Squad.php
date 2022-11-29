<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Squad extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = "squads";
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'squad_employees');
    }
}
