<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'first_name',
        'last_name',
        'avatar',
        'email'
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
        return User::class;
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
