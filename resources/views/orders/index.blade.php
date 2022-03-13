@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="container">
     <div class="col-md-4">
           <form action="{{ route('orders.search')}}" method="GET">
               {{-- @csrf --}}
               <div class="input-group">
                    <input type="search" placeholder="Citizen customer card" name="citizen_card" class="form-control" style="float:right" required>
                    <span class="input-group-prepend">
                         <button type="submit" class="btn btn-outline-primary">Search</button>
                    </span>
               </div>
           </form>
     </div>
     <br>
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
                                        <th>Customer</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Shipper</th>
                                        <th>Carrier</th>
                                        <th>Tracking</th>
                                        <th>Status</th>
                                        <th scope="col" width="1%" colspan="3"></th>
                                        <th scope="col" width="1%" colspan="3"></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   @forelse($orders as $order)
                                        <tr>
                                             <td>{{ $loop->index +1 }}</td>
                                             <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                                             <td>{{ $order->order_date }}</td>
                                             <td>{{ $order->delivery_date ?? '-'}}</td>
                                             <td>{{ $order->shipper }}</td>
                                             <td>{{ $order->courier }}</td>
                                             <td>{{ $order->tracking }}</td>
                                             <td>{{ $order->status->status }}</td>
                                             
                                             <td><a href="{{ route('orders.show', $order) }}" class="btn btn-warning btn-sm">show</a></td>
                                             <td>
                                                  {!! Form::open(['method' => 'DELETE','route' => ['orders.destroy', $order],'style'=>'display:inline']) !!}
                                                  {!! Form::submit('delete', ['class' => 'btn btn-danger btn-sm', 'onclik' => "return confirm('Are you sure?')"]) !!}
                                                  {!! Form::close() !!}
                                             </td>
                                        </tr>   
                                   @empty
                                        <tr>
                                             <td><span>No data available</span></td>
                                        </tr>
                                   @endforelse
                              </tbody>
                         </table>
                    </div> 
               </div> 
     
               {{-- @if($users->render()->paginator->currentPage() <= $users->render()->paginator->lastPage()) --}}
               <div class="d-flex">
                    {{ $orders->render() }}
               </div>
               <div class="card-footer">
                    {{ date('Y-m-d H:i') }}
               </div>
             </div>
         </div>
     </div>
 </div>
@endsection
