<?php

namespace App\Repositories;

use App\Models\Attendance;
use Carbon\Carbon;

class DashboardRepository
{
    /** @var DetailstblRepository */
    private $detailstblRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DetailstblRepository $detailstblRepository)
    {
        $this->detailstblRepository = $detailstblRepository;
    }

    private function getDashboardInfo($request)
    {
        $dashboardInfo = [];
        $dashboardInfo['detailstbls_count'] =  $this->detailstblRepository->count();
        $dashboardInfo['detailstbls'] =  $this->detailstblRepository->getPaging([
            'search' => $request ? $request->all() : [],
            'orderBy' => $request->has('orderBy') ? $request->query('orderBy') : null,
            'sortOrder' => $request->has('sortOrder') ? $request->query('sortOrder') : null,
        ]);
        return $dashboardInfo;
    }

    public function getData($request)
    {
        return $this->getDashboardInfo($request);
    }

    public function storeOrder($request)
    {
        $this->detailstblRepository->create($request);
    }

    public function updateOrder($request)
    {
        $this->detailstblRepository->create($request);
    }

    public function find($id)
    {
        $this->detailstblRepository->find($id);
    }

    public function update($request, $id)
    {
        $this->detailstblRepository->update($request, $id);
    }

    public function advancedSearch($request)
    {
        return $this->getDashboardInfo($request);
    }
}
