<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use DB;
use Illuminate\Mail\Message;
use Response;
use Intervention\Image\Facades\Image;
use App\Mail\Registration;
use App\Mail\PasswordChangeCode;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;



class RegisterController extends Controller
{
    public function registerUser(Request $request)
    {
        // var_dump($request->name);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users|email',
            'password' => 'required|min:8|string',
            'password_confirmation' => 'required|min:8|string|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;


        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'password_confirmation' => bcrypt($request->get('password_confirmation'))
        ]);

        if (!$user) {
            return response()->json($user->errors());
        }
       
        try{
            //https://mailtrap.io/blog/send-email-in-laravel/        
            $verification_code = str_random(30); //Generate verification code
            DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);

            //The email sending is done using the to method on the Mail facade
            Mail::to($email)->send(new Registration($name, $verification_code));
            //$user = User::first();
            //difference between JWTAuth::fromUser($user),JWTAuth::toUser($user) and JWTAuth::attempt($user) 
            //$token = JWTAuth::fromUser($user);

           // return Response::json(compact('token'));

            return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email to complete your registration.']);
        } catch(JWTException $exception){
            return response()->json($exception);
        }
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

        /*
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
            */

            try{

                if(preg_match('/^data:image\/(\w+);base64,/', $request->user_image)){
                $value = substr($request->user_image, strpos($request->user_image, ',') + 1);
                $image = base64_decode($value);
            
                $file_cloud_url = Cloudinary::uploadFile($image->getRealPath())->getSecurePath();

                if (isset($file_cloud_url['status']) && $file_cloud_url['status'] == false) {
                    return $file_cloud_url;
                }

                $image_path = $file_cloud_url;

                $user_image = User::where('email', $email)->update([
                'user_image' => $image_path,
            ]);

            return $user_image;
            }else {
                return response()->json("Image not saved", 401);
            }
            

            }catch(\Exception $e){
      throw $e;
    }
        
    }


    /**
     * API Verify User Email
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyUser($verification_code)
    {
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();

        if(!is_null($check)){
            $user = User::find($check->user_id);

            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..'
                ]);
            }

            $user->update(['is_verified' => 1, 'scope'=> 'commenter']);
            DB::table('user_verifications')->where('token',$verification_code)->delete();

            return response()->json([
                'success'=> true,
                'message'=> 'You have successfully verified your email address.'
            ]);
            
        }

        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);

    }

    public function requestPasswordChangeCode(Request $request)
    {

        try{

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }

        $verification_code = str_random(30); //Generate verification code
        DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);

        $name = $user->name;
        $email = $request->email;

        Mail::to($email)->send(new PasswordChangeCode($name, $verification_code));

        return response()->json([
            'success' => true, 'data'=> ['message'=> 'A reset email has been sent! Please check your email.']
        ]);
    } catch(\Exception $error){
        throw $error;


    }

    }

        //getenv('FROM_EMAIL_ADDRESS'), 
        
            //$subject = "Password Change Request.";
           // Mail::send([], ['name' => $name, 'verification_code' => $verification_code],
            /*
            function($mail) use ($email, $name, $subject, $verification_code){
                $mail->from("Support@CityPeople.com", "CityPeople")
                ->to($email, $name)
                ->subject($subject)
                //https://stackoverflow.com/questions/26139931/laravel-mail-pass-string-instead-of-view
                ->html("<div>
                Hi {{ $name }},
                <br>
                Here is your verification code: $verification_code
                <br>
                Please, copy the above verification code and click on the link below to change your password:
                <br>            
                <a href='http://localhost:3000/passwordchange'>Confirm my email address</a>
            
                <br/>
                </div>", "text/html");
            });
        }

        

           
        }
        

            /*
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Your Password Reset Link');
            });
*/

/*
        } catch (Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
*/
      

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'email' => 'required|email',
            'newpassword' => 'required|min:8|string',
            'newpassword_confirmation' => 'required|min:8|string|same:newpassword',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try{
        $verification_code = $request->code;
        $newpassword = bcrypt($request->newpassword);
        $newpassword_confirmation = bcrypt($request->newpassword_confirmation);

        $check = DB::table('user_verifications')->where('token',$verification_code)->first();

        if(!is_null($check)){
            $user = User::find($check->user_id);

            $user->update(['password' => $newpassword, 'password_confirmation'=> $newpassword_confirmation]);
            DB::table('user_verifications')->where('token',$verification_code)->delete();
            Auth::logout();

            return response()->json([
                'success'=> true,
                'message'=> 'You have successfully changed your password.'
            ]);
        }

    } catch(\Exception $error){
    return response()->json(['success'=> false, 'error'=> "Password change credentials invalid."]);
}
}

 /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

}