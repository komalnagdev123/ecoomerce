<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "id";

    public $fillable = [
        'user_id',
        'order_no',
        'order_date',
        'estimate_delivery_date',
        'total_qty',
        'ship_price',
        'order_status_id',
        'total_amount',
        'status',
        'status_update_date',
    ];

    public function viewOrderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
