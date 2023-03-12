<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Validator;


class LoginController extends Controller
{
    public function loginUser(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            if (!$credentials) {
                return response()->json(['success' => false, 'error' => $credentials->messages()], 401);
            }

            $info = $request->only('email', 'password');
            $token = JWTAuth::attempt($info);
            $user = Auth::user();

            if ($token) {
                return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'user' => $user,
                //'expires_in' => $this->guard()->factory()->getTTL() * 60 * 60 * 3 // to expire in 3 hours 
                "expires_in" => Auth::factory()->getTTL() * 60 * 60 * 3 // to expire in 3 hours
        ]);
    }
        } catch (JWTException $exception) {
            return response()->json($exception);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => $this->guard()->factory()->getTTL() * 60 * 60
        ]);
    }


    public function logoutUser()
    {
        Auth::logout();
    }

    public function allUsers(){
        $users = User::all()->paginate(20);
        return $users;
    }

}
