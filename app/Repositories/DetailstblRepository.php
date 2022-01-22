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
        'InstallNo',
        'ProjectNo',
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
     * Configure the Model
     **/
    public function model()
    {
        return Detailstbl::class;
    }
}
