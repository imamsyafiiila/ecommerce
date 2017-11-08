<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int ord_order_number
 * @property string ord_description
 * @property int ord_amount
 * @property int ord_status
 * @property string ord_created_at
 * @property string ord_updated_at
 * @property mixed ord_id
 */
class Order extends Model
{
    public $primaryKey = 'ord_id';
    public $timestamps = false;

    protected $table = 'tbl_order';

    protected $fillable = [
        'ord_id',
        'ord_order_number',
        'ord_description',
        'ord_amount',
        'ord_status'
    ];

    public function saveToOrder($type, $params) {
        $today = date("ymd");
        $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
        $unique = $today . $rand;

        $description = '';
        $amount = '';

        // Prepaid Balance
        if ($type == config('constant.TYPE_ORDER_PREPAID')) {
            $description = $params['param2'].'.000 for '.$params['param1'];
            $amount = ($params['param2'] * 1000) + ($params['param2'] * 50);
        }

        // Prepaid Balance
        if ($type == config('constant.TYPE_ORDER_PRODUCT')) {
            $description = $params['param1'].' that costs '.$params['param3'].'.000';
            $amount = $params['param3'] + 10000;
        }

        $this->ord_order_number = $unique;
        $this->ord_description = $description;
        $this->ord_amount = $amount;
        $this->ord_status = config('constant.STATUS_ORDER_NEW');
        $this->ord_created_at = date('Y-m-d H:i:s');

        return $this->save();
    }

    public function orderProductEcommerce()
    {
        return $this->hasOne('App\Productecom', 'pro_ord_id', 'ord_id');
    }
}
