<?php

namespace App\Http\Controllers;

use App\Models\Bizdirectoryproducts;
use Illuminate\Http\Request;

class BizdirectoryproductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $bizproducts = Bizdirectoryproducts::all();
	   // return $bizproducts;
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
     * @param  \App\Http\Requests $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'business_name' => 'required',
            'product_name_slug' => 'required',
            'slug' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'user_id' => 'required',
            'biz_location' => 'required',
        ]);

        $product = new Bizdirectoryproducts();
        $product->business_name = $request->business_name;
        $product->product_name = $request->product_name;
        $product->product_name_slug = $request->product_name_slug;
        $product->slug = $request->slug;
        $product->phone = $request->phone;
        $product->biz_location = $request->biz_location;
        $product->description = $request->description;
        $product->user_id = $request->user_id;        
    
        Bizdirectoryproducts::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bizdirectoryproducts  $bizdirectoryproducts
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        if(exist(Bizdirectoryproducts::where('slug', $slug))){
            $product = Bizdirectoryproducts::where('slug', $slug)->get();
            return $product;
        }else {
            return('Product not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bizdirectoryproducts  $bizdirectoryproducts
     * @return \Illuminate\Http\Response
     */
    public function showProduct($productname)
    {
        //
        if(exist(Bizdirectoryproducts::where('product_name', $productname))){
            $product = Bizdirectoryproducts::where('product_name', $slug)->get();
            return $product;
        }else {
            return('Product not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests  $request
     * @param  \App\Models\Bizdirectoryproducts  $bizdirectoryproducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $product = Bizdirectoryproducts::where('slug', $slug)->update([
            'business_name' => $request->business_name,
            'slug' => $request->slug,
            'product_name' => $request->product_name,
            'product_name_slug' => $request->product_name_slug,
            'description' => $request->description,
            'phone' => $request->phone,
            'biz_location' => $request->biz_location,
        ]);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bizdirectoryproducts  $bizdirectoryproducts
     * @return \Illuminate\Http\Response
     */
    public function destroy($productname)
    {
        //
        $product = Bizdirectoryproducts::where('product_name', $productname)->get();
        return $product->delete();
    }
}
