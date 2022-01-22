<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\DashboardRepository;

class DashboardController extends Controller
{
    /** @var  DashboardRepository */
    private $dashboardRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DashboardRepository $dashboardRepo)
    {
        $this->dashboardRepository = $dashboardRepo;
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
        return view('dashboard.order');
    }

    /**
     * create new order
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrder (Request $request)
    {
        $data = $this->dashboardRepository->storeOrder ($request);
        return view('dashboard.index', $data);
    }

    /**
     * show advanced search
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdvancedSearch ()
    {
        return view('dashboard.advanced_search');
    }

     /**
     * handle advanced search
     *
     * @return \Illuminate\Http\Response
     */
    public function handleAdvancedSearch (Request $request)
    {
        $data = $this->dashboardRepository->advancedSearch ($request);
        return view('dashboard.index', $data);
    }
}
