<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::make([
            'order_date' => $request->input('order_date'),
            'shipper' => $request->input('shipper'),
            'consignee' => $request->input('consignee'),
            'carrier' => $request->input('carrier'),
            'customer_id' => Auth::guard('api')->id(),
            'total_price' =>  $request->input('total_price'),
            'status_id' => 1,
            'purchase_detail' => $request->input('purchase_detail'),
        ]);

        $tracking = 'OR' . (hexdec(substr(uniqid(), 0, 9)) + (int) $order->id) . 'EC';  //create random tracking
        $order->tracking = $tracking;

        $file = $request->file('invoice_file');
        $invoiceFileName = time() . '-' . $file->getClientOriginalName();

        //Store invoice file
        $request->invoice_file->move(public_path('images'), $invoiceFileName);
        
        $order->invoice_file = $invoiceFileName;
        $order->save();

        return [
            'sucess' => true,
            'message' => 'Order created successfully'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $toBeConfirmedStatusId = OrderStatus::firstwhere(
            'abbreviation', 'PC'
        )->id;

        $statusId = $request->input('status_id');

        $order = Order::findOrFail($id);

        if($order->status_id != $toBeConfirmedStatusId) 
        {
            return response()->json([
                'status'  => false,
                'message' => 'Order status cannot be cancelled'
            ]);
        }

        $order->update(['status_id' => $statusId]);

        return response()->json([
            'status'  => true,
            'message' => 'Order status updated succesfully'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
