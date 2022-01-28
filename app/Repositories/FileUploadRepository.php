<?php

namespace App\Repositories;

use App\Models\FileUpload;
use App\Repositories\BaseRepository;

/**
 * Class FileUploadRepository
 * @package App\Repositories
 * @version August 14, 2021, 1:13 am +07
*/

class FileUploadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'file_upload'
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
        return FileUpload::class;
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
