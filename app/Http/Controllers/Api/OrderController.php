<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
            'courier' => $request->input('courier'),
            'remarks' => $request->input('remarks'),
            'customer_id' => Auth::guard('api')->id(),
            'status_id' => 1
        ]);
        $tracking = 'OR' . (hexdec(substr(uniqid(), 0, 9)) + (int) $order->id) . 'EC';  //create random tracking
        $order->tracking = $tracking;

        $productsId = array_filter(explode(',', $request->input('products')));
        $products = DB::table('products')->whereIn('id', $productsId)->get();
        $totalOrder = 0;

        foreach ($products as $product) {
            $totalOrder += $product->price;
        }

        $order->total_price = $totalOrder;
        $order->save();     //save order

        $order->items()->attach($productsId);   //save products

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
        //
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
        //
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
