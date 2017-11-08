<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed pro_ord_id
 * @property mixed pro_product
 * @property mixed pro_shipping_address
 * @property mixed pro_price
 * @property false|string pro_created_at
 */
class Productecom extends Model
{
    public $primaryKey = 'pro_id';
    public $timestamps = false;

    protected $table = 'tbl_productecom';

    protected $fillable = [
        'pro_product',
        'pre_shipping_address'
    ];
}
