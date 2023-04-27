<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasActivity;
    /**
     * @var string
     */
    protected $table = 'drivers';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
}
