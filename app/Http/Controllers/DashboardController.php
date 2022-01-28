<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\DashboardRepository;
use App\Repositories\DealertblRepository;
use App\Repositories\DetailstblRepository;
use App\Repositories\CustomertblRepository;
use App\Repositories\IhStafftblRepository;
use App\Repositories\TrucktblRepository;
use Flash;
class DashboardController extends Controller
{
    /** @var DashboardRepository */
    private $dashboardRepository;

    /** @var DetailstblRepository */
    private $detailstblRepository;

    /** @var DealertblRepository */
    private $dealertblRepository;

    /** @var CustomertblRepository */
    private $customertblRepository;

    /** @var IhStafftblRepository */
    private $ihStafftblRepository;

    /** @var TrucktblRepository */
    private $trucktblRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DashboardRepository $dashboardRepo, DetailstblRepository $detailstblRepository, DealertblRepository $dealertblRepository, CustomertblRepository $customertblRepository, IhStafftblRepository $ihStafftblRepository, TrucktblRepository $trucktblRepository)
    {
        $this->dashboardRepository = $dashboardRepo;
        $this->detailstblRepository = $detailstblRepository;
        $this->dealertblRepository = $dealertblRepository;
        $this->customertblRepository = $customertblRepository;
        $this->ihStafftblRepository = $ihStafftblRepository;
        $this->trucktblRepository = $trucktblRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->dashboardRepository->getData($request);
        return view('dashboard.index', $data);
    }

     /**
     * Search filter orders
     *
     * @return \Illuminate\Http\Response
     */
     public function search(Request $request)
     {
        $data = $this->dashboardRepository->getData($request);
        return view('dashboard.index', $data);
     }

    /**
     * show new order
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder ()
    {
        $data['dealers'] = $this->dealertblRepository->getSelectOptions();
        $data['customers'] = $this->customertblRepository->getSelectOptions();
        $data['ihstaffs'] = $this->ihStafftblRepository->getSelectOptions();
        $data['trucks'] = $this->trucktblRepository->getSelectOptions();
        return view('dashboard.order', $data);
    }

    /**
     * create new order
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrder (Request $request)
    {
        $data = $this->detailstblRepository->store($request->all());
        return redirect(route('dashboard'));
    }

    /**
     * Update the specified order in database.
     *
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */
    public function updateOrder ($id, Request $request)
    {
        $order = $this->detailstblRepository->find($id);
        if (empty($order)) {
            Flash::error('Order not found');
            return redirect(route('dashboard'));
        }
        $this->detailstblRepository->edit($request->all(), $id);
        Flash::success('Order updated successfully.');

        return redirect(route('dashboard'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdvancedSearch(Request $request)
    {
        $data = $this->dashboardRepository->getData($request);
        $data['dealers'] = $this->dealertblRepository->getSelectOptions();
        $data['customers'] = $this->customertblRepository->getSelectOptions();
        $data['ihstaffs'] = $this->ihStafftblRepository->getSelectOptions();
        $data['trucks'] = $this->trucktblRepository->getSelectOptions();
        return view('dashboard.advanced_search', $data);
    }

     /**
     * handle advanced search
     *
     * @return \Illuminate\Http\Response
     */
    public function handleAdvancedSearch (Request $request)
    {
        $data = $this->dashboardRepository->getData($request);
        $data['dealers'] = $this->dealertblRepository->getSelectOptions();
        $data['customers'] = $this->customertblRepository->getSelectOptions();
        $data['ihstaffs'] = $this->ihStafftblRepository->getSelectOptions();
        $data['trucks'] = $this->trucktblRepository->getSelectOptions();
        return view('dashboard.advanced_search', $data);
    }
}
