@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
          <div class="col-md-8">
             <div class="card">
               <div class="card-header">
                    <h3 class="card-title">Create products</h3>
               </div>
 
               <div class="card-body">
                    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                         @csrf <!-- THIS IS ADDED IN ORDER TO PROTECT AGAINST CROSS-SITE REQUEST FORGERY-->
                         <div class="form-row">
                              <div class="form-group col-md-6">
                                   <label for="product_name">Product name</label>
                                   <input type="text" class="form-control" name="product_name" id="product_name" autofocus required>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="product_image">Product image</label>
                                   <input type="file" class="form-control" name="product_image" id="product_image" accept=".jpeg,.png,.jpg" required>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="price">Price</label>
                                   <input type="number" class="form-control" name="price" min="0.00" step="0.01" placeholder="E.g. 9.99" required/>
                              </div>
                         </div>
                         <input type="submit" class="btn btn-success" value="Save it!">
                    </form>
               </div> 
     
               <div class="card-footer">
               </div>
             </div>
         </div>
     </div>
 </div>
@endsection
