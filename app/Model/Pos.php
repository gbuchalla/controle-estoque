<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $table = 'pos';

    protected $fillable = [
        'product_id', 'product_name', 'product_quantity', 'product_price', 'sub_total'
    ];
}
