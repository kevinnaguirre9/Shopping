<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Closure;

class UserController extends Controller
{
    /**
     * Get authenticated user information
     */
    public function show() 
    {
        $userId = Auth::guard('api')->id();
        $User = User::findOrFail($userId);

        return $User;
    }

    /**
     * Get authenticated user orders
     */
    public function getOrders() 
    {
        $orders = collect(Auth::guard('api')->user()->orders)
                    ->map($this->mapOrder())
                    ->toArray();

        return $orders;
    }

    /**
     * @return Closure
     */
    private function mapOrder() 
    {
        return function(Order $order) 
        {
            return [
                'id' => $order->id,
                'order_date' => $order->order_date,
                'delivery_date' => $order->delivery_date,
                'shipper' => $order->shipper,
                'consignee' => $order->consignee,
                'carrier' => $order->carrier,
                'tracking' => $order->tracking,
                'status' => $order->status->status,
                'total_price' => $order->total_price,
                'purchase_detail' => $order->purchase_detail
            ];
        };
    }
}
