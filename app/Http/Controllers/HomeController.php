<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $orders = DB::table('orders')->where('user_id', auth()->id())->get();
        $orders = Order::where('user_id', auth()->id())->get();
        // $orderProducts = OrderProduct::where(auth()->user()->orders->id)->get();

        // dd(auth()->user()->orders);
        // dd($orderProducts);

        $orderProducts = $orders->map(function ($order) {
            return OrderProduct::where('order_id', $order->id)->get();
        });

        dd($orderProducts);


        return view('home', ['orders' => $orders]);
    }
}
