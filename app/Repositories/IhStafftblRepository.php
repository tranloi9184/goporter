<?php

namespace App\Repositories;

use App\Models\IhStafftbl;
use App\Repositories\BaseRepository;

class IhStafftblRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'IhStaff',
    ];
  
    /**
     * @var array
     */
    protected $fieldDateSearchable = [];

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
        return IhStafftbl::class;
    }

    /*get select options */
    public function getSelectOptions(){
        $ihStaffs = $this->all();
        $data = [];
        if(count($ihStaffs) > 0){
            foreach($ihStaffs as $key=>$ihStaff){
                //$data[$ihStaff->ID] = $ihStaff->IHStaff;
                $data[$ihStaff->IHStaff] = $ihStaff->IHStaff;
            }
        }
        return array_unique($data);
    }

    public function getTimeOptions(){
        $maxHour = 12;
        $maxMinues = 60;
        $data = [];
        $hours = [];
        $minutes = [];
        for($i=0; $i <= $maxHour; $i++) {
            $hour = $i < 10 ? '0'.$i : $i;
            $hours[$hour] = $hour;
        }
        for($i=0; $i <= $maxMinues; $i++) {
            $minute = $i < 10 ? '0'.$i : $i;
            $minutes[$minute] = $minute;
        }
        $data['hours'] = $hours;
        $data['minutes'] = $minutes;
        $data['format'] = [
            'AM' => 'AM',
            'PM' => 'PM'
        ];
        return $data;
    }
}
