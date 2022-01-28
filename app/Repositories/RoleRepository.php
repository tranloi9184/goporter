<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\BaseRepository;

/**
 * Class RoleRepository
 * @package App\Repositories
 * @version July 23, 2021, 5:54 pm UTC
*/

class RoleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'title',
        'guard_name',
        'description'
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
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
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
}
