<?php

namespace App\Http\Controllers;

use App\Order;
use App\Prepaidbalance;
use App\Productecom;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Http\Request;

class PayController extends Controller
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
        $order_number = '';
        if (isset($_POST['order_number'])) {
            $order_number = $_POST['order_number'];
        } else if (isset($_GET['order_number'])) {
            $order_number = $_GET['order_number'];
        }

        return view('pay.create', [
            'order_number' => $order_number
        ]);
    }
    public function savepay(Request $request)
    {
        $request->validate([
            'number' => 'required|exists:tbl_order,ord_order_number',
        ]);

        $order = Order::where('ord_order_number', '=', $request->input('number'))
            ->firstOrFail();

        $order_date = strtotime($order->ord_created_at) + 300;

        $status = config('constant.STATUS_ORDER_SUCCESS');
        if (strtotime(now()) > $order_date) {
            $status = config('constant.STATUS_ORDER_FAIL');
        }

        // Check for Product Ecommerce
        $productecom = Productecom::where('pro_ord_id', '=', $order->ord_id)
            ->first();
        if ($productecom) {
            $rand = strtoupper(substr(uniqid(sha1(time())),0,8));
            $productecom->pro_shipping_code = $rand;

            $productecom->save();
            $status = config('constant.STATUS_ORDER_PRODUCT');
            if (strtotime(now()) > $order_date) {
                $status = config('constant.STATUS_ORDER_FAIL');
            }
        }

        $order->ord_status = $status;
        $order->ord_updated_at = date('Y-m-d H:i:s');
        $order->save();

        return redirect('home');
    }
}
