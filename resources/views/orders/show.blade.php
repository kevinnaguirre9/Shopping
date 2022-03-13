@extends('layouts.app')

@section('styles')
<style>
/* Style the Image Used to Trigger the Modal */
     img {
     border-radius: 5px;
     cursor: pointer;
     transition: 0.3s;
     }

     img:hover {opacity: 0.7;}

     /* The Modal (background) */
     #image-viewer {
     display: none;
     position: fixed;
     z-index: 1;
     padding-top: 100px;
     left: 0;
     top: 0;
     width: 100%;
     height: 100%;
     overflow: auto;
     background-color: rgb(0,0,0);
     background-color: rgba(0,0,0,0.9);
     }
     .modal-content {
     margin: auto;
     display: block;
     width: 80%;
     max-width: 700px;
     }
     .modal-content { 
     animation-name: zoom;
     animation-duration: 0.6s;
     }
     @keyframes zoom {
     from {transform:scale(0)} 
     to {transform:scale(1)}
     }
     #image-viewer .close {
     position: absolute;
     top: 15px;
     right: 35px;
     color: #f1f1f1;
     font-size: 40px;
     font-weight: bold;
     transition: 0.3s;
     }
     #image-viewer .close:hover,
     #image-viewer .close:focus {
     color: #bbb;
     text-decoration: none;
     cursor: pointer;
     }

     @media only screen and (max-width: 700px){
     .modal-content {
          width: 100%;
     }
     }
</style>
@endsection

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
                         <div class="row">
                              <div class="col">
                                   <label><b>Customer</b></label>
                                   <p class="form-control">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
                              </div>
                              <div class="col">
                                   <label><b>Order date</b></label>
                                   <p class="form-control">{{ $order->order_date }}</p>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <label><b>Delivery date</b></label>
                                   <p class="form-control">{{ $order->delivery_date ? $order->delivery_date : 'Order not delivered yet' }}</p>
                              </div>
                              <div class="col">
                                   <label><b>Shipper</b></label>
                                   <p class="form-control">{{ $order->shipper }}</p>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <label><b>Carrier</b></label>
                                   <p class="form-control">{{ $order->carrier }}</p>
                              </div>
                              <div class="col">
                                   <label><b>Tracking</b></label>
                                   <p class="form-control">{{ $order->tracking }}</p>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <label><b>Order details</b></label>
                                   <textarea class="form-control" readonly>{{ $order->purchase_detail }}</textarea>
                              </div>
                              <div class="col">
                                   <label><b>Total order price</b></label>
                                   <p class="form-control">${{ $order->total_price }}</p>
                              </div>
                         </div>
                         <br>
                         <div class="form-row">
                              <div class="form-group col-md-3">
                                   <label for="status_id"><b>Order status</b></label>
                                   <select name="status_id" id="status_id" class="form-control">
                                        @foreach($statuses as $status)
                                             <option value="{{ $status->id }}" {{  $order->status_id === $status->id ? 'selected' : ''}}>{{ $status->status }}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <br>
                              <div class="form-group col-md-2">
                                   <input class="btn btn-primary" id="btnShowInvoice" type="button" value="See invoice">
                              </div>
                         </div>

                         <div id="image-viewer">
                              <span id="closeButton" class="close">&times;</span>
                              <img class="modal-content" src="{{ asset('images/' . $order->invoice_file) }}" id="full-image">
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

@section('scripts')
<script type="application/javascript">
     window.onload = function() {
          document.getElementById('btnShowInvoice').addEventListener('click', function (e) 
          {
               document.getElementById('image-viewer').style.display = 'block';
          });

          document.getElementById('closeButton').addEventListener('click', function (e) 
          {
               document.getElementById('image-viewer').style.display = 'none';
          });
     }   

</script>

@endsection