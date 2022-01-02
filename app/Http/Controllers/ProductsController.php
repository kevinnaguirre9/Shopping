<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(6);
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //die(var_dump($request->file()));
        $request->validate([
            'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //Build image name
        $file = $request->file('product_image');
        $image_contents = file_get_contents($file);
        $image_name = time() . '-' . preg_replace('/\s+/', '', $request->product_name) . '.' . $file->extension();
        $img_bucket_path = 'images/' . $image_name;
        $image_url = "https://" . env('AWS_BUCKET') .  ".s3." . env('AWS_DEFAULT_REGION') . ".amazonaws.com/" . $img_bucket_path;
        //Store image
        Storage::disk('s3')->put($img_bucket_path, $image_contents);

        Product::create([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'image_path' => $image_url
        ]);   

        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
