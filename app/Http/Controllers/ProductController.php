<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product['category'] = Product::find($product->id)->category;
            $product['supplier'] = Product::find($product->id)->supplier;
        }
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = DB::select("SHOW TABLE STATUS LIKE 'products'");
        $id = $id[0]->Auto_increment;

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        if(!empty($request->image)){
            $image = $request->image;
            $type = explode(';', explode('/', explode(',', $image)[0])[1])[0];
            $image = str_replace("data:image/$type;base64,", '', $image);
            $image = str_replace(' ', '+', $image);
            $filename = "image/product/product-$id.$type";
            Storage::disk('public')->put($filename, base64_decode($image));
            $product->image = asset('storage/'.$filename);
        }

        $product->save();
        return response()->json([$product], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $product =Product::find($id);
        $product->name = $request->name;
        $product->qr = $request->qr;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        if(!empty($request->image)){
            $image = $request->image;
            $type = explode(';', explode('/', explode(',', $image)[0])[1])[0];
            $image = str_replace("data:image/$type;base64,", '', $image);
            $image = str_replace(' ', '+', $image);
            $filename = "image/product/product-$id.$type";
            Storage::disk('public')->put($filename, base64_decode($image));
            $product->image = asset('storage/'.$filename);
        }
        $product->save();
        return response()->json([$request, 'message' => 'Updated Successfully', 'response' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json(['http' => 200]);
    }
}
