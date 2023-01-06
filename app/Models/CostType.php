<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostType extends Model
{
    use SoftDeletes;

    protected $table = 'cost_types';
    protected $guarded = ['id'];
}
