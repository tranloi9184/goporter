<?php

namespace App\Repositories;

use App\Models\Detailstbl;
use App\Repositories\BaseRepository;

class DetailstblRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'Dealer',
        'Customer',
        'ProjectNo',
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
        'Lead',
        'LeadEmail',
        'ScreensBk',
        'OpensBk',
        'FlatsBk',
    ];

    /**
     * @var array
     */
    protected $fieldDateSearchable = [
        'StartTime',
        'SiteTime',
        'EquipBkDate',
    ];
  
    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Return searchable date fields
     *
     * @return array
     */
    public function getFieldDateSearchable()
    {
        return $this->fieldDateSearchable;
    }
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Detailstbl::class;
    }

    public function store ($input){
        $vehicles = $input['Vehicles'];
        if($vehicles && is_array($vehicles)){
            $vehicles = implode(',', $vehicles);
        }
        $input['Vehicles'] = $vehicles;
        $input['InstallNo'] = (int)$input['InstallNo'];
        return $this->create($input);
    }

    public function edit ($input, $id){
        $vehicles = $input['Vehicles'];
        if($vehicles && is_array($vehicles)){
            $vehicles = implode(',', $vehicles);
        }
        $input['Vehicles'] = $vehicles;
        $input['InstallNo'] = (int)$input['InstallNo'];
        return $this->update($input, $id);
    }
}
