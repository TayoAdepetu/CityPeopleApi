<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Tymon\JWTAuth\Exceptions\JWTException;
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

            if ($token = Auth::attempt($request->only('email', 'password'))) {
                return $this->respondWithToken($token);
            }

            /* throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.']
            ]); */
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
