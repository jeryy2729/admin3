<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
        protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'address', 'products', 'total_amount', 'status'
    ];

}
