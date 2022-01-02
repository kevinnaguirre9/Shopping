<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['order_items'];

    protected $table = 'orders';

    protected $fillable = ['delivery_date', 'courier', 'tracking', 'status_id', 'total_price', 'remarks', 'customer_id'];

    protected $primaryKey = 'id';

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function status() {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

}
