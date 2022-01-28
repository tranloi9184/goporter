<?php

namespace App\Models;

use Eloquent as Model;

class Dealertbl extends Model
{
    public $table = 'dealertbl';
    /**
     * @var array
     */
    protected $fillable = [
        'Dealer',
    ];
}
