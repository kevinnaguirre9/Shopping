@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
          <div class="col-md-8">
             <a type="button" href="{{ route('products.create') }}" class="btn btn-success btn-sm" style="float:right">Add products</a>
             <br><br>
             <div class="card">
               <div class="card-header">
                    <h3 class="card-title">Products</h3>
               </div>
 
               <div class="card-body">
                    <div class="table-responsive">
                         <table class="table table-hover">
                              <thead>
                                   <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th scope="col" width="1%" colspan="3">Actions</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   @forelse($products as $product)
                                        <tr>
                                             <td>{{ $loop->index+1 }}</td>
                                             <td>{{ $product->product_name }}</td>
                                             <td>{{ $product->price }}</td>
                                             <td><a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">edit</a></td>
                                             <td>
                                                  {!! Form::open(['method' => 'DELETE','route' => ['products.destroy', $product],'style'=>'display:inline']) !!}
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
                    {{ $products->render() }}
                    </div>
               </div>
               <div class="card-footer">
                    {{ date('Y-m-d H:i') }}
               </div>
             </div>
         </div>
     </div>
 </div>
@endsection
