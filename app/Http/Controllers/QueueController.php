<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\QueueRepository;

class QueueController extends Controller
{
    /** @var  QueueRepository */
    private $queueRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(QueueRepository $queueRepo)
    {
        $this->queueRepository = $queueRepo;
    }

    /**
     * Show the application queue.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->queueRepository->GetData();
        return view('queue.index', $data);
    }
}
