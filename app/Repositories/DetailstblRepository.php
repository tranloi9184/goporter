<?php

namespace App\Repositories;

use App\Models\Detailstbl;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
class DetailstblRepository extends BaseRepository
{
    /**
     * @var pagination limit
     */
    const PAGING_LIMIT = 15;

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
        $vehicles = '';
        if(isset($input['Vehicles']) && is_array($input['Vehicles'])){
            $vehicles = implode(',', $input['Vehicles']);
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

    /* search schedules */
    public function searchEquipBkDate ($params)
    {
        //DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $fromDate = isset($params['fromDate']) ? $params['fromDate'] : null;
        $toDate = isset($params['toDate']) ? $params['toDate'] : null;
        $limit = isset($params['limit']) ? $params['limit'] : self::PAGING_LIMIT;
        $columns = isset($params['columns']) ? $params['columns'] : ['*'];
        $query = $this->model->newQuery();
        if ($fromDate) {
            $query->where('EquipBkDate', '>=', $fromDate);
        }
        if ($toDate) {
            $query->where('EquipBkDate', '<=', $toDate);
        }
        //$query->groupBy('EquipBkDate');
        $result = $query->paginate($limit, $columns);
        $data = [];
        if($result->total() > 0){
            foreach ($result as $key=>$item){
                $equipBkDate = date('d-m-Y', strtotime($item->EquipBkDate));
                if(!array_key_exists($equipBkDate, $data)){
                    $data[$equipBkDate] = [];
                }
                array_push($data[$equipBkDate], $item);
            }
        }
        return $data;
    }
}
