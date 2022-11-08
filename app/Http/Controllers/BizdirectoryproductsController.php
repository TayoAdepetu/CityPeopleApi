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
        
       $bizproducts = Bizdirectoryproducts::all();
	   return $bizproducts;
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
            'business_name_slug' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'price' => 'required',
            'user_id' => 'required',
            'biz_location' => 'required',
        ]);


        function generateKey(){
            $str = "12356890abcefghjklnopqrsuvwxyz()/$";
            $randStr = substr(str_shuffle($str), 0);
            while(exist(Bizdirectoryproducts::where('product_name_slug', $randStr))){
                $randStr = substr(str_shuffle($str), 0);
            }

                return $randStr;
            }

        $product = new Bizdirectoryproducts();
        $product->business_name = $request->business_name;
        $product->product_name = $request->product_name;
        $product->product_name_slug = generateKey();
        $product->business_name_slug = $request->business_name_slug;
        $product->phone = $request->phone;
        $product->price = $request->price;
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
    public function show($business_name_slug)
    {
        //
        if(exist(Bizdirectoryproducts::where('business_name_slug', $business_name_slug))){
            $product = Bizdirectoryproducts::where('business_name_slug', $slug)->get();
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
        if(exist(Bizdirectoryproducts::where('product_name_slug', $productname))){
            $product = Bizdirectoryproducts::where('product_name_slug', $productname)->get();
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
        $product = Bizdirectoryproducts::where('product_name_slug', $product_name_slug)->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'phone' => $request->phone,
            'biz_location' => $request->biz_location,
            'price' => $request->price,
        ]);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bizdirectoryproducts  $bizdirectoryproducts
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_name_slug)
    {
        //
        $product = Bizdirectoryproducts::where('product_name_slug', $product_name_slug)->get();
        return $product->delete();
    }
}
