<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use JWTAuth;
use Validator;
use Response;
use Image;

class RegisterController extends Controller
{
    public function registerUser(Request $request)
    {
        // var_dump($request->name);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|string',
            'password_confirmation' => 'required|min:8|string|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }


        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'password_confirmation' => bcrypt($request->get('password_confirmation'))
        ]);

        $user = User::first();
        $token = JWTAuth::fromUser($user);

        return Response::json(compact('token'));
    }

    //let users supply business name before they can have bizdirectory
    public function updateUserBiz(Request $request, $email){
        $business_name = User::where('email', $email)->update([
            'business_name' => $request->business_name,
            'business_name_slug' => $request->business_name_slug,
        ]);

        return $business_name;
    }

    public function updateUserImage(Request $request, $email){        

            if(preg_match('/^data:image\/(\w+);base64,/', $request->user_image)){
                $value = substr($request->user_image, strpos($request->user_image, ',') + 1);
                $user = Auth::user();
                $filename = $user->name . '.' .'png';
                $location = public_path('userimage/' . $filename);
                //using the intervention library we installed to save in laravel folder
                Image::make($value)->resize(800, 400)->save($location);
                //put image name in database so that we can use it to search the folder when we need it
                $user_image = User::where('email', $email)->update([
                'user_image' => $filename
            ]);

            return $user_image;
        }
        
    }
}
