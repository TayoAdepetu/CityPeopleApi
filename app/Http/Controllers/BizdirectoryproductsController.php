<?php

namespace App\Http\Controllers;

use App\Models\Bizdirectoryproducts;
use App\Models\Bizdirectory;
use App\Models\User;

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
        
       $bizproducts = Bizdirectoryproducts::with('user')->get();
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
            'product_name_slug' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'user_id' => 'required',
            'location' => 'required',
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
        $product->product_name = $request->product_name;
        $product->product_name_slug = generateKey();
        $product->price = $request->price;
        $product->location = $request->biz_location;
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
        $user = User::where('business_name_slug', $business_name_slug)->first();
        $product = $user->products()->with('user')->get();
        return $product;
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
        $product = Bizdirectoryproducts::with('user')->where('product_name_slug', $productname)->get();
        return $product;
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
            'location' => $request->biz_location,
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
