<?php

namespace App\Models;

use Eloquent as Model;
class Detailstbl extends Model
{
    public $table = 'detailstbl';
    /**
     * @var array
     */
    protected $fillable = [
        'Dealer',
        'Customer',
        'ProjectNo',
        'StartTime',
        'StartWhere',
        'IhStaff',
        'Subs',
        'Equip',
        'Vehicles',
        'Screens',
        'Opens',
        'Flats',
        'LineNo',
        'Double',
        'Address',
        'SiteTime',
        'Lead',
        'LeadEmail',
        'ScreensBk',
        'OpensBk',
        'FlatsBk',
        'EquipBkDate',
    ];
}
