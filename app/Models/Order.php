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
        'product_id',
        'user_id',
        'order_status',
        'payment_method',
        'payment_status',
        'address'
    ];

    
}
