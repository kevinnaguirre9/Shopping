<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItems;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['order_items'];

    protected $table = 'orders';

    protected $fillable = ['delivery_date', 'courier', 'tracking', 'status_id', 'total_price', 'remarks', 'customer_id'];

    protected $primaryKey = 'id';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function status() {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function order_items() {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    public function items() {
        //return $this->hasMany(OrderItems::class, 'order_id');
        return $this->belongsToMany(Product::class, 'order_items')
                    ->withTimestamps();
    }

}
