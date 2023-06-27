<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $table = 'extra';

    protected $fillable = [
        'tax', 'logo', 'favicon', 'phone', 'email', 'address'
    ];
}