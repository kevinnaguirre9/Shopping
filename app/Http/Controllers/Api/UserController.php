<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function show() {
        return Auth::guard('api')->user();
    }

    public function getOrders() {
        $userID = Auth::guard('api')->id();
        $user = User::findOrFail($userID);
        $orders = $user->orders;
        $data = [];
        
        if($orders->count() > 0) {
            foreach($orders as $order) {
                $data[] = [
                    'id' => $order->id,
                    'order_date' => $order->order_date,
                    'delivery_date' => $order->delivery_date,
                    'courier' => $order->courier,
                    'traking' => $order->tracking,
                    'total_price' => $order->total_price,
                    'remarks' => $order->remarks,
                    'status' => $order->status->status,
                    'items' => $order->items
                ];
            }
        }

        return $data;
    }
}
