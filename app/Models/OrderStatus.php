<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_statuses';   

    protected $primaryKey = 'id'; 

    protected $fillable = ['status'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

}
