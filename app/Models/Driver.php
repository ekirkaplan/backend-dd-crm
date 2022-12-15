<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /**
     * @var string
     */
    protected $table = 'drivers';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
}
