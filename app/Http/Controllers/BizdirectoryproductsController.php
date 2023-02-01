<?php

namespace App\Http\Controllers;

use App\Models\Bizdirectoryproducts;
use App\Models\Bizdirectory;
use App\Models\User;
use App\Models\Productimages;

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
        
       $bizproducts = Bizdirectoryproducts::with('user')->paginate(5);
	   return $bizproducts;
    }

    public function indexMore()
    {
        
       $bizproducts = Bizdirectoryproducts::with('user')->paginate(20);
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
            'images' => 'required',
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
        $product->product_name_slug = $request->product_name. '/' .generateKey();
        $product->price = $request->price;
        $product->location = $request->biz_location;
        $product->description = $request->description;
        $product->user_id = $request->user_id;

        $product_images = $request->images;

        foreach($product_images as $product_image){
            if(preg_match('/^data:image\/(\w+);base64,/', $product_image)){
                $value = substr($request->image, strpos($request->image, ',') + 1);
                //$value = base64_decode($value);
                $filename = $request->product_name_slug. '.' .'png';
                $location = public_path('productimage/' . $filename);
                //using the intervention library we installed to save in laravel folder
                //Image::make($value)->resize(800, 400)->save($location);
                Image::make($value)->save($location);
                //put image name in database so that we can use it to search the folder when we need it                

                Productimages::create([
                    'product_image_path' => $filename,
                    'user_id' => $product->user_id,
                    'product_name_slug' => $product->product_name_slug,
                ]);
        
        }
        }
    
        $product->save();
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
