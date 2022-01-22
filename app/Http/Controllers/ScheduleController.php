<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ScheduleRepository;

class ScheduleController extends Controller
{
    /** @var  ScheduleRepository */
    private $scheduleRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepository = $scheduleRepo;
    }

    /**
     * Show the application schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->scheduleRepository->GetData();
        return view('schedule.index', $data);
    }
}
