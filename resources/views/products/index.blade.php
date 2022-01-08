@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
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
                                             <td>${{ $product->price }}</td>
                                             <td><a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">edit</a></td>
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
     
               <div class="card-footer">
                    {{ $products->render() }}
               </div>
             </div>
         </div>
     </div>
 </div>
@endsection
