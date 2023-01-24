<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class AfrimagesController extends Controller
{
    //

    public function storeImages(Request $request){
        $request->validate([
            'image_name' => 'required',
            'image_description' => 'required',
            'category_id' => 'required|integer',
            'user_id' => 'required',
            'image' => 'required',
            //'image_path' => 'required',
            //'photo_id' => 'required',
        ]);

        $image = new Afrimages();
        $image->image_name = $request->image_name;
        $image->image_description = $request->image_description;
        $image->category_id = $request->category_id;
        $image->user_id = $request->user_id;

         function generateKey(){
            $str = "12356890abcefghjklnopqrsuvwxyz()/$";
            $randStr = substr(str_shuffle($str), 0);
            while(exist(Bizdirectoryproducts::where('product_name_slug', $randStr))){
                $randStr = substr(str_shuffle($str), 0);
            }

                return $randStr;
            }

            $image->photo_id = generateKey();

          if(preg_match('/^data:image\/(\w+);base64,/', $request->image)){
                $value = substr($request->image, strpos($request->image, ',') + 1);
                //$value = base64_decode($value);
                $filename = $request->slug. '/'.$image->photo_id. '.' .'png';
                $location = public_path('postimage/' . $filename);
                //using the intervention library we installed to save in laravel folder
                Image::make($value)->resize(800, 400)->save($location);
                //put image name in database so that we can use it to search the folder when we need it
                
                $image->image_path = $filename;
        }

        $image->save();
    }

    public function showByUsername($username)
    {
        //
        $user = User::where('name', $username)->first();
        $image = $user->images()->with('user')->get();
        return $image;
    }

    public function showByImagePath($image_path)
    {
        //
        $image = Afrimages::where('image_path', $image_path)->with('user')->first();
        return $image;
    }
}
