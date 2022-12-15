<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * @var string
     */
    protected $table = 'vehicles';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
}
