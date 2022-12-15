<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxOffice extends Model
{
    /**
     * @var string
     */
    protected $table = 'tax_offices';
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
}
