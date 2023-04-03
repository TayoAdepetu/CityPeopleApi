<?php

namespace App\Http\Controllers;

use App\Models\Myproducts;
use App\Models\Bizdirectory;
use App\Models\User;
use App\Models\Productimages;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Auth;


class MyproductsController extends Controller
{
       public function index()
    {
        
       $bizproducts = Myproducts::inRandomOrder()->with('user', 'productimages')->limit(5)->orderBy('created_at', 'desc')->get();
	   return $bizproducts;
    }

    public function indexMore()
    {
        
       $bizproducts = Myproducts::inRandomOrder()->with('user', 'productimages')->limit(20)->orderBy('created_at', 'desc')->get();
	   return $bizproducts;
    }


    public function store(Request $request)
    {
        //
        try {
            $validator = $request->validate([
                'product_name_slug' => 'required|string',
                'product_name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|string',
                'user_id' => 'required|integer',
                'delivery_days' => 'required|string',
                'landing_page_title' => 'required|string',
                'headline_support' => 'required|string',
                'images' => 'required|string',
                'reviews_pictures' => 'required|string',
                'FAQs_pictures' => 'required|string',
                'more_pictures' => 'required|string',
            ]);

            if(!$validator){
                return response()->json("check your credentials", 401);
            }

            $product_images = $request->images;
            $FAQs_pictures = $request->FAQs_pictures;
            $more_pictures = $request->more_pictures;
            $reviews_pictures = $request->reviews_pictures;

            if (sizeof($product_images) < 5) {

                function generateKey()
                {
                    $str = "12356890abcefghjklnopqrsuvwxyz()/$";
                    $randStr = substr(str_shuffle($str), 0);
                    if (Myproducts::where('product_name_slug', $randStr)->exists()) {
                        $randStr = substr(str_shuffle($str), 0);
                    }

                    return $randStr;
                }

                $product = new Myproducts();
                $product->product_name = $request->product_name;
                $product->product_name_slug = $request->product_name_slug . '/' . generateKey();
                $product->price = $request->price;
                $product->delivery_days = $request->delivery_days;
                $product->description = $request->description;
                $product->user_id = $request->user_id;
                $product->landing_page_title = $request->landing_page_title;
                $product->headline_support = $request->headline_support;
                

                foreach ($product_images as $product_image) {

                    if (preg_match('/^data:image\/(\w+);base64,/', $product_image)) {
                        //https://www.php.net/manual/en/arrayobject.offsetget.php
                        //https://support.cloudinary.com/hc/en-us/community/posts/5806959634962-how-to-read-secure-url-from-the-response-object-after-uploading-in-php

                       // $user = User::where('id', $request->user_id)->get();

                        $cloudinary = new UploadApi();
                        $file_cloud_url = $cloudinary->upload($product_image, ['resource_type' => 'image', "folder" => "city_product_images/"]);

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

                if (preg_match('/^data:image\/(\w+);base64,/', $FAQs_pictures)) {
                     $cloud = new UploadApi();
                     $FAQs_url = $cloud->upload($FAQs_pictures, ['resource_type' => 'image', "folder" => "city_product_images/"]);
                    
                     if (isset($FAQs_url['status']) && $FAQs_url['status'] == false) {
                            return $FAQs_url;
                        }
                    
                    $product->FAQs_pictures = $FAQs_url->offsetGet('secure_url');
                }

                if (preg_match('/^data:image\/(\w+);base64,/', $more_pictures)) {
                     $cloud = new UploadApi();
                     $more_url = $cloud->upload($more_pictures, ['resource_type' => 'image', "folder" => "city_product_images/"]);
                    
                     if (isset($more_url['status']) && $more_url['status'] == false) {
                            return $more_url;
                        }
                    
                    $product->more_pictures = $more_url->offsetGet('secure_url');
                }

                if (preg_match('/^data:image\/(\w+);base64,/', $reviews_pictures)) {
                     $cloud = new UploadApi();
                     $reviews_url = $cloud->upload($reviews_pictures, ['resource_type' => 'image', "folder" => "city_product_images/"]);
                    
                     if (isset($reviews_url['status']) && $reviews_url['status'] == false) {
                            return $reviews_url;
                        }
                    
                    $product->reviews_pictures = $reviews_url->offsetGet('secure_url');
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
        $product = Myproducts::with('user', 'productimages')->where('product_name_slug', $productname)->get();
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
        $product = Myproducts::where('product_name_slug', $product_name_slug)->update([
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
        $product = Myproducts::where('product_name_slug', $product_name_slug)->get();
        return $product->delete();
    }
}
