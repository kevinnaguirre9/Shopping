<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_items';

    protected $fillable = ['order_id', 'product_id', 'quantity'];

    protected $primaryKey = 'id';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
