<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/

Route::group([

    'middleware' => 'auth:api',

], function ($router) {

    Route::get('auth/user', 'App\Http\Controllers\LoginController@me');
});

Route::post('auth/login', 'App\Http\Controllers\LoginController@loginUser');
Route::post('auth/register', 'App\Http\Controllers\RegisterController@registerUser');
Route::post('auth/logout', 'App\Http\Controllers\LoginController@logout');
