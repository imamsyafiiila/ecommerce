<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed pre_ord_id
 * @property mixed pre_phone_number
 * @property mixed pre_value
 * @property false|string pre_created_at
 */
class Prepaidbalance extends Model
{
    public $timestamps = false;

    protected $table = 'tbl_prepaidbalance';

    protected $fillable = [
        'pre_phone_number',
        'pre_value'
    ];
}
