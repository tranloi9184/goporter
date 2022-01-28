<?php

namespace App\Repositories;

use App\Models\Dealertbl;
use App\Repositories\BaseRepository;

class DealertblRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'Dealer',
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
        return Dealertbl::class;
    }

    /*get select options */
    public function getSelectOptions(){
        $dealers = $this->all();
        $data = [];
        if(count($dealers) > 0){
            foreach($dealers as $key=>$dealer){
              //  $data[$dealer->ID] = $dealer->Dealer;
                $data[$dealer->Dealer] = $dealer->Dealer;
            }
        }
        return $data;
    }
}
