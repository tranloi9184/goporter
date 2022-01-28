<?php

namespace App\Models;

use Eloquent as Model;

class Customertbl extends Model
{
    public $table = 'customertbl';
    /**
     * @var array
     */
    protected $fillable = [
        'Customer',
    ];
}
