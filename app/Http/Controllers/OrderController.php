<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    /** @var  OrderRepository */
    private $orderRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Show the application order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->orderRepository->GetData();
        return view('order.index', $data);
    }
}
