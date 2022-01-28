<?php

namespace App\Models;

use Eloquent as Model;

class Trucktbl extends Model
{
    public $table = 'truckstbl';
    /**
     * @var array
     */
    protected $fillable = [
        'Truck',
    ];
}
