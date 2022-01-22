<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detailstbl extends Model
{
    use SoftDeletes;

    public $table = 'detailstbl';
}
