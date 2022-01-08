@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
          <div class="col-md-12">
             <div class="card">
               <div class="card-header">
                    <h3 class="card-title">Order Information</h3>
               </div>
 
               <div class="card-body">
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                         <!-- cross-site request forgery -->
                         @csrf
                         @method('PUT')
                         <div class="form-group w-25">
                              <label><b>Customer:</b></label>
                              <p class="form-control">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
                         </div>
                         <div class="form-group w-25">
                              <label><b>Delivery date:</b></label>
                              <p class="form-control">{{ $order->delivery_date ? $order->delivery_date : 'Order not delivered yet'}}</p>
                         </div>
                         <div class="form-group w-25">
                              <label><b>Courier:</b></label>
                              <p class="form-control">{{ $order->courier }}</p>
                         </div>
                         <div class="form-group w-25">
                              <label><b>Tracking:</b></label>
                              <p class="form-control">{{ $order->tracking }}</p>
                         </div>
                         <div class="form-group w-50">
                              <label><b>Order items</b></label>
                              <ul>
                                   @foreach($order->items as $item)
                                        <li><i>{{ $item->product_name }}</i> ${{ $item->price }}</li>
                                   @endforeach
                              </ul>
                         </div>
                         <div class="form-group w-25">
                              <label><b>Total order price</b></label>
                              <p class="form-control">${{ $order->total_price }}</p>
                         </div>
                         <div class="form-group w-25">
                              <label for="status_id"><b>Order status</b></label>
                              <select name="status_id" id="status_id" class="form-control">
                                   @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{  $order->status_id === $status->id ? 'selected' : ''}}>{{ $status->status }}</option>
                                   @endforeach
                              </select>
                         </div>
                         <br>
                         <button type="submit" class="btn btn-success">Update order status</button>
                    </form>          
               </div> 
     
               <div class="card-footer">
                    {{ date('Y-m-d H:i') }}
               </div>
             </div>
         </div>
     </div>
 </div>
@endsection
