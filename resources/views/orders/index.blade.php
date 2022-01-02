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
                                        <th>Customer</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Courier</th>
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
                                             <td>{{ $order->courier }}</td>
                                             <td>{{ $order->tracking }}</td>
                                             <td>
                                                  <select name="status_id" id="status_id" onchange="updateOrderStatus({{ $order->id }}, this.value, {{ $loop->index +1 }});">
                                                       @foreach($statuses as $status)
                                                            <option value="{{ $status->id }}" {{  $order->status_id === $status->id ? 'selected' : ''}}>{{ $status->status }}</option>
                                                       @endforeach
                                                  </select>
                                                  <div class="spinner-border spinner-border-sm border-row-{{ $loop->index +1 }}" hidden role="status">
                                                       <span class="sr-only"></span>
                                                  </div>                                                  
                                             </td>
                                             <td><a href="{{ route('orders.show', $order) }}" class="btn btn-warning btn-sm">show</a></td>
                                             <td>
                                                  {!! Form::open(['method' => 'DELETE','route' => ['orders.destroy', $order],'style'=>'display:inline']) !!}
                                                  {!! Form::submit('delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                  {!! Form::close() !!}
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
      async function updateOrderStatus(order_id, status_id, row_number) {
          const spinner = document.querySelector(`.border-row-${row_number}`);
          const is_completed = status_id == "3";
          spinner.removeAttribute("hidden");
          const res = await axios.put(`http://localhost:8000/orders/${order_id}`, {status_id, is_completed});
          //spinner.setAttribute("hidden", "true");
          window.location.assign(res.data.redirectURL);
      }
 </script>
@endsection
