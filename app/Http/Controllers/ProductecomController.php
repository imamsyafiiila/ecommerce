<?php

namespace App\Http\Controllers;

use App\Order;
use App\Prepaidbalance;
use App\Productecom;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Http\Request;

class ProductecomController extends Controller
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

        return view('product_ecommerce.create');
    }

    public function store(Request $request) {
        $request->validate([
            'product' => 'required|between:10,150',
            'address' => 'required|between:10,150',
            'price' => 'required|numeric',
        ]);
        $request->validate([
            'number' => [function ($attribute, $value, $fail){
                if(!(substr($value, 0, 3) == '081')) {
                    $fail(':attribute needs prefix 081!');
                }
            }]
        ]);

        $params = [
            'param1' => $request->input('product'),
            'param2' => $request->input('address'),
            'param3' => $request->input('price'),
        ];
        // save to tbl_order
        $order = new Order();
        $order->saveToOrder(config('constant.TYPE_ORDER_PRODUCT'), $params);

        // save to tbl_productecom
        $product = new Productecom();
        $product->pro_ord_id = $order->ord_id;
        $product->pro_product = $params['param1'];
        $product->pro_shipping_address = $params['param2'];
        $product->pro_price = $params['param3'];
        $product->pro_created_at = date('Y-m-d H:i:s');

        $product->save();

        $params = [
            config('constant.TYPE_ORDER_PRODUCT'),
            $order->ord_order_number,
            $order->ord_amount,
            $product->pro_product,
            $product->pro_price,
            $product->pro_shipping_address
        ];

        return view('order.orderresult', [
            'params' => $params
        ]);
    }
}
