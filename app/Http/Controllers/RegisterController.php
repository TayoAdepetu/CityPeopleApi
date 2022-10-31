<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use Validator;
use Response;

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
}
