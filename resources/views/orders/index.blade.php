@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
          <div class="col-md-12">
             <div class="card">
               <div class="card-header">
                    <h3 class="card-title">Last orders</h3>
               </div>
 
               <div class="card-body">
                    <div class="table-responsive">
                         <table class="table table-hover">
                              <thead>
                                   <tr>
                                        <th>#</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Courier</th>
                                        <th>Tracking</th>
                                        <th>Customer</th>
                                        <th scope="col" width="1%" colspan="3">Actions</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   @forelse($orders as $order)
                                        <tr>
                                             <td>{{ $loop->index+1 }}</td>
                                             <td>{{ $order->order_date }}</td>
                                             <td>{{ $order->delivery_date }} {{ $order->last_name }}</td>
                                             <td>{{ $order->courier }}</td>
                                             <td>{{ $order->tracking }}</td>
                                             <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                                             <td><a href="{{ route('orders.show', $order) }}" class="btn btn-warning btn-sm">Show</a></td>
                                             <td>
                                                  <select name="order_status" id="order_status" onchange="">
                                                       @foreach($statuses as $status)
                                                            <option value="{{ $status->id }}" {{  $order->status_id === $status->id ? 'selected' : ''}}>{{ $statuses->status }}</option>
                                                       @endforeach
                                                  </select>
                                                  <div class="spinner-border spinner-border-sm" role="status">
                                                       <span class="sr-only">Loading...</span>
                                                  </div>
                                             </td>
                                        </tr>   
                                   @empty
                                        {{-- <tr>
                                             <td>NO MORE DATA</td>
                                        </tr> --}}
                                   @endforelse
                              </tbody>
                         </table>
                    </div> 
               </div> 
     
               {{-- @if($users->render()->paginator->currentPage() <= $users->render()->paginator->lastPage()) --}}
               <div class="d-flex">
                    {{ $orders->render() }}
                    </div>
               </div>
               <div class="card-footer">
                    {{ date('Y-m-d H:i') }}
               </div>
             </div>
         </div>
     </div>
 </div>
 <script>
      async function updateOrderStatus(id, status_id) {
          //Load spinner
          const res = await axios.put('http://localhost:8000/orders/${id}', { 'status_id' : status_id });
          //Hide spinner
      }
 </script>
@endsection
