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
             <div class="card">
               <div class="card-header">
                    <h3 class="card-title">Update product</h3>
               </div>
 
               <div class="card-body">
                    <form action="{{ route('products.update', $product)}} " method="POST">
                         @csrf <!-- THIS IS ADDED IN ORDER TO PROTECT AGAINST CROSS-SITE REQUEST FORGERY-->
                         @method('PUT')
                         <div class="form-row">
                              <div class="form-group col-md-6">
                                   <label for="product_name">Product name</label>
                                   <input type="text" class="form-control" name="product_name" id="product_name" value="{{ $product->product_name }}"autofocus required>
                              </div>
                              <br>
                              <div class="form-group col-md-6">
                                   <label for="price">Price</label>
                                   <input type="number" class="form-control" name="price" min="0.00" step="0.01" placeholder="E.g. 9.99" value="{{ $product->price }}" required/>
                              </div>
                         </div>
                         <br>
                         <input type="submit" class="btn btn-success" value="Update">
                    </form>
               </div> 
     
               <div class="card-footer">
               </div>
             </div>
         </div>
     </div>
 </div>
@endsection
