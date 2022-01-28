<?php

namespace App\Repositories;

use App\Models\Trucktbl;
use App\Repositories\BaseRepository;

class TrucktblRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'Truck',
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
        return Trucktbl::class;
    }

    /*get select options */
    public function getSelectOptions(){
        $trucks = $this->all();
        $data = [];
        if(count($trucks) > 0){
            foreach($trucks as $key=>$truck){
                $data[$truck->ID] = $truck->Truck;
            }
        }
        return $data;
    }
}
