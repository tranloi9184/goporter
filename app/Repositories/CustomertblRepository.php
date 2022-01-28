<?php

namespace App\Repositories;

use App\Models\Customertbl;
use App\Repositories\BaseRepository;

class CustomertblRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'Customer',
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
        return Customertbl::class;
    }

    /*get select options */
    public function getSelectOptions(){
        $customers = $this->all();
        $data = [];
        if(count($customers) > 0){
            foreach($customers as $key=>$customers){
               // $data[$customers->ID] = $customers->Customer;
                $data[$customers->Customer] = $customers->Customer;
            }
        }
        return $data;
    }
}
