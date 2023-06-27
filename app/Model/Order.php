<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'customer_id', 'quantity', 'sub_total', 'tax', 'total', 'pay', 'due', 'payment_method', 'order_date', 'order_month', 'order_year'
    ];
}