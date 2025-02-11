<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status_id', 'user_id', 'total_price'];

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
