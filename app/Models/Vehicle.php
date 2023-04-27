<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasActivity;
    /**
     * @var string
     */
    protected $table = 'vehicles';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
}
