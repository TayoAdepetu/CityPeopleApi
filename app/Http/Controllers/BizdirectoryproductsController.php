<?php

namespace App\Http\Controllers;

use App\Models\Bizdirectoryproducts;
use App\Models\Bizdirectory;
use App\Models\User;
use App\Models\Productimages;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BizdirectoryproductsController extends Controller
{
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

   
    public function store(Request $request)
    {
        //
        $request->validate([
            //'product_name_slug' => 'required|string',
            'product_name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|string',
            'user_id' => 'required|integer',
            'location' => 'required|string',
            'images' => 'required',
        ]);


        function generateKey(){
            $str = "12356890abcefghjklnopqrsuvwxyz()/$";
            $randStr = substr(str_shuffle($str), 0);
            if(Bizdirectoryproducts::where('product_name_slug', $randStr)->exists()){
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

        foreach ($product_images as $product_image) {
            $file_cloud_url = Cloudinary::uploadFile($product_image->getRealPath())->getSecurePath();

                if (isset($file_cloud_url['status']) && $file_cloud_url['status'] == false) {
                    return $file_cloud_url;
                }

                $file_path = $file_cloud_url;
                $image_public_id = $file_cloud_url->getPublicId();

            Productimages::create([
                'product_image_path' => $file_path,
                'user_id' => $product->user_id,
                'image_public_id' => $image_public_id,
                'product_name_slug' => $product->product_name_slug,
            ]);

        }

        $product->save();

        /*
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
        */

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

 
    public function showProduct($productname)
    {
        //
        $product = Bizdirectoryproducts::with('user')->where('product_name_slug', $productname)->get();
        return $product;
    }


    public function update(Request $request, $product_name_slug)
    {
        //
         $validator = $request->validate([
            'product_name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|string',
            'location' => 'required|string',
        ]);

        if($validator){
        $product = Bizdirectoryproducts::where('product_name_slug', $product_name_slug)->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'location' => $request->biz_location,
            'price' => $request->price,
        ]);

        return $product;
    }
    }

    public function destroy($product_name_slug)
    {
        //
        $product = Bizdirectoryproducts::where('product_name_slug', $product_name_slug)->get();
        return $product->delete();
    }
}
