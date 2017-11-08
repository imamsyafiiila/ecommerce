<?php

namespace App\Http\Controllers;

use App\Order;
use App\Prepaidbalance;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Http\Request;

class PrepaidbalanceController extends Controller
{
    use FormAccessible;

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
        $prepaidbalance = new Prepaidbalance();

        return view('prepaid_balance.create', [
            'prepaid_balance' => $prepaidbalance
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'number' => 'required|numeric|digits_between:7,12',
            'value' => 'required',
        ]);
        $request->validate([
            'number' => [function ($attribute, $value, $fail){
                if(!(substr($value, 0, 3) == '081')) {
                    $fail(':attribute needs prefix 081!');
                }
            }]
        ]);

        $params = [
            'param1' => $request->input('number'),
            'param2' => $request->input('value'),
        ];
        // save to tbl_order
        $order = new Order();
        $order->saveToOrder(config('constant.TYPE_ORDER_PREPAID'), $params);

        // save to tbl_prepaidbalance
        $prepaid = new Prepaidbalance();
        $prepaid->pre_ord_id = $order->ord_id;
        $prepaid->pre_phone_number = $params['param1'];
        $prepaid->pre_value = $params['param2'];
        $prepaid->pre_created_at = date('Y-m-d H:i:s');

        $prepaid->save();

        $params = [
            config('constant.TYPE_ORDER_PREPAID'),
            $order->ord_order_number,
            $order->ord_amount,
            $prepaid->pre_phone_number,
            $prepaid->pre_value
        ];

        return view('order.orderresult', [
            'params' => $params
        ]);
    }
}
