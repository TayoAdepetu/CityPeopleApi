<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Facades\Response;
use App\Models\Blogimage;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BlogimageController extends Controller
{
  //

    public function index()
    {
        //
        $images = Blogimage::with('user')->orderBy('created_at', 'desc')->paginate(5);
	    return $images;
      
    }

    public function indexMore()
    {
        //
        $images = Blogimage::with('user')->orderBy('created_at', 'desc')->paginate(20);
	    return $images;
      
    }

    public function storeImages(Request $request){ 

        /*
         function generateKey(){
            $str = "12356890abcefghjklnopqrsuvwxyz()/$";
            $randStr = substr(str_shuffle($str), 0);
            while(exist(Afrimages::where('photo_id', $randStr))){
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

        */

        function generateKey(Request $request)
                {
                    $str = "12356890abcefghjklnopqrsuvwxyz()/$";
                    $randStr = substr(str_shuffle($str), 0);
                    if (Blogimage::where('image_name_slug', $request->image_name_slug.'-'.$randStr)->exists()) {
                        $randStr = substr(str_shuffle($str), 0);
                    }

                    return $randStr;
                }

        try{
            $request->validate([
            'image_name' => ['required', 'string', 'unique:afrimages'],
            'image_name_slug' => 'required|string',
            'image_description' => ['required', 'string', 'min:2'],
            'user_id' => 'required|integer',
            'image' => 'required',
            
        ]);

        $image = new Blogimage();
        $image->image_name = $request->image_name;
        $image->image_description = $request->image_description;
        $image->image_name_slug = $request->image_name_slug.'-'.generateKey();
        $image->user_id = $request->user_id;

        // upload profile picture to cloudinary if available
            if ($request->file('image')) {
                $file_cloud_url = Cloudinary::uploadFile($request->file('image')->getRealPath())->getSecurePath();

                if (isset($file_cloud_url['status']) && $file_cloud_url['status'] == false) {
                    return $file_cloud_url;
                }

                $image->image_path = $file_cloud_url;
                $image->public_id = $file_cloud_url->getPublicId();                
            }

            $image->save();

         }catch(\Exception $e){
      throw $e;
    }
    }

    public function showByUsername($username)
    {
        //
        $user = User::where('name', $username)->first();
        $image = $user->images()->with('user')->paginate(20);
        return $image;
    }

    public function showByImagePath($image_path)
    {
        //
        $image = Blogimage::where('image_path', $image_path)->with('user')->first();
        return $image;
    }

    public function downloadImage(Request $request, $image_path){
        //using the image path store in database to fetch from cloudinary
        $filepath = Blogimage::where('image_path', $image_path);
        return Response::download($filepath);
       

    }

    public function deleteImage(Request $request, $image_path) {

        /*to delete video... you have to put the resource type
        Cloudinary::destroy($post->videoFileId, ["resource_type" => "video"]);
        */

        //unlink("postimage/".$image_path);
       $image = Blogimage::where("image_path", $image_path)->get();
       Cloudinary::destroy($image->public_id);
       Blogimage::where("image_path", $image_path)->delete();

       return back()->with("success", "Image deleted successfully.");

    }

    public function update(Request $request, $image_path)
    {
        //
        $validator = $request->validate([
            'image_name' => ['required', 'string', 'unique:afrimages'],
            'image_description' => ['required', 'string', 'min:2'],
            'category_id' => 'required|integer',
        ]);

        if($validator){
        $newImage = Blogimage::where('image_path', $image_path)->update([
            'image_name' => $request->image_name,
            //'category_id' => $request->category_id,
            'image_description' => $request->image_description,
        ]);

        return $newImage;
    }
    
    }

}

