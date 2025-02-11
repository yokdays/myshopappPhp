<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    use HasFactory;
    protected $guarded = [];

    function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
}
