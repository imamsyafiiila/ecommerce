<?php

namespace App\Http\Controllers;

use App\Order;
use App\Productecom;
use Illuminate\Http\Response;
use Psy\Util\Json;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::paginate(15);

        return view('order.index', [
            'orders' => $orders
        ]);
    }

    public function search()
    {
        if (!empty($_REQUEST['id'])) {
            if (strlen($_REQUEST['id']) < 10) {
                $orders = Order::where('ord_order_number', 'like', '%' . $_REQUEST['id'] . '%')->get();
            } else {
                $orders = Order::where('ord_order_number', '=', $_REQUEST['id'])->get();
            }
        } else {
            $orders = Order::all();
        }

        // fill the shipping code
        foreach ($orders as $key => $order) {
            if ($order['ord_status'] == config('constant.STATUS_ORDER_PRODUCT')) {
                $productecom = Productecom::where('pro_ord_id', '=', $order->ord_id)->first();
                $orders[$key]['ord_status'] = $productecom->pro_shipping_code;
            }
        }

        return Json::encode($orders);
    }

    public function getCode()
    {
        $orders = Productecom::where('pro_ord_id', '=', $_REQUEST['id'])->first();
        return Json::encode([$orders->pro_shipping_code]);
    }
}
