<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeType extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'employe_types';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];
}
