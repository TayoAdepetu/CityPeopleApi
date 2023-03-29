<?php

namespace App\Http\Controllers;

use App\Models\Bizdirectoryproducts;
use App\Models\Bizdirectory;
use App\Models\User;
use App\Models\Productimages;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;


class BizdirectoryproductsController extends Controller
{
       public function index()
    {
        
       $bizproducts = Bizdirectoryproducts::with('user', 'productimages')->paginate(5);
	   return $bizproducts;
    }

    public function indexMore()
    {
        
       $bizproducts = Bizdirectoryproducts::with('user', 'productimages')->paginate(20);
	   return $bizproducts;
    }


    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                //'product_name_slug' => 'required|string',
                'product_name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|string',
                'user_id' => 'required|integer',
                'location' => 'required|string',
                'images' => 'required',
            ]);

            $product_images = $request->images;

            if (sizeof($product_images) < 5) {

                function generateKey()
                {
                    $str = "12356890abcefghjklnopqrsuvwxyz()/$";
                    $randStr = substr(str_shuffle($str), 0);
                    if (Bizdirectoryproducts::where('product_name_slug', $randStr)->exists()) {
                        $randStr = substr(str_shuffle($str), 0);
                    }

                    return $randStr;
                }

                $product = new Bizdirectoryproducts();
                $product->product_name = $request->product_name;
                $product->product_name_slug = $request->product_name . '/' . generateKey();
                $product->price = $request->price;
                $product->location = $request->biz_location;
                $product->description = $request->description;
                $product->user_id = $request->user_id;

                foreach ($product_images as $product_image) {

                    if (preg_match('/^data:image\/(\w+);base64,/', $product_image)) {
                        //https://www.php.net/manual/en/arrayobject.offsetget.php
                        //https://support.cloudinary.com/hc/en-us/community/posts/5806959634962-how-to-read-secure-url-from-the-response-object-after-uploading-in-php

                        $user = User::where('id', $request->user_id)->get();

                        $cloudinary = new UploadApi();
                        $file_cloud_url = $cloudinary->upload($product_image, ['resource_type' => 'image', "folder" => "cityavatar/", "public_id" => $user->name]);

                        if (isset($file_cloud_url['status']) && $file_cloud_url['status'] == false) {
                            return $file_cloud_url;
                        }

                        $file_path = $file_cloud_url->offsetGet('secure_url');
                        $image_public_id = $file_cloud_url->offsetGet('public_id');

                        Productimages::create([
                            'product_image_path' => $file_path,
                            'user_id' => $product->user_id,
                            'image_public_id' => $image_public_id,
                            'product_name_slug' => $product->product_name_slug,
                        ]);

                    } else {
                        return response()->json("Image not saved", 401);
                    }
                }

                $product->save();
            }else{
                return response()->json("Images more than 5", 401);
            }

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function show($business_name_slug)
    {
        //
        $user = User::where('business_name_slug', $business_name_slug)->first();
        $product = $user->products()->with('user', 'productimages')->get();
        return $product;
    }

 
    public function showProduct($productname)
    {
        //
        $product = Bizdirectoryproducts::with('user', 'productimages')->where('product_name_slug', $productname)->get();
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
