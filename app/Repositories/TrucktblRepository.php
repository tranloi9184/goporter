<?php

namespace App\Repositories;

use App\Models\Trucktbl;
use App\Repositories\BaseRepository;

class TrucktblRepository extends BaseRepository
{
    const VERHICLES = [
        'Cargo', '5ton', 'ENT', 'Eco'
    ];
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
        $maxIndex = 25;
        $maxIndexC = 26;
        if(count($trucks) > 0){
            foreach($trucks as $key=>$truck){
                $data[$truck->ID] = $truck->Truck;
            }
        }
        foreach(self::VERHICLES as $key=>$truck){
            $data[$truck] = $truck;
        }
        for($i=1; $i <= $maxIndex; $i++) {
            $data['#'.$i] = '#'.$i;
        }
        for($i=1; $i <= $maxIndexC; $i++) {
            $data['C'. $i] = 'C'.$i;
        }

        return array_unique($data);
    }
}
