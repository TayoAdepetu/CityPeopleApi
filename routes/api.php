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

//For Posts
Route::get('auth/posts', 'App\Http\Controllers\PostController@index');
Route::post('auth/create-new-post', 'App\Http\Controllers\PostController@store');
Route::get('auth/blog/{slug}', 'App\Http\Controllers\PostController@show');
Route::post('auth/update-post/{slug}', 'App\Http\Controllers\PostController@update');


//For Jobs
Route::get('auth/jobs', 'App\Http\Controllers\JobsdirectoryController@index');
Route::post('auth/create-new-job', 'App\Http\Controllers\JobsdirectoryController@store');
Route::get('auth/job/{slug}', 'App\Http\Controllers\JobsdirectoryController@show');
Route::post('auth/update-job/{slug}', 'App\Http\Controllers\JobsdirectoryController@update');

//For Bizdirectoryproducts
//Route::get('auth/all-products', 'App\Http\Controllers\BizdirectoryproductsController@index');
Route::post('auth/create-directory-product', 'App\Http\Controllers\BizdirectoryproductsController@store');
Route::get('auth/products/{businessname}', 'App\Http\Controllers\JBizdirectoryproductsController@show');
//Route::post('auth/update-product/{slug}', 'App\Http\Controllers\BizdirectoryproductsController@update');
Route::get('auth/product/{productname}', 'App\Http\Controllers\JBizdirectoryproductsController@showProduct');
Route::delete('auth/delete-product/{productname}', 'App\Http\Controllers\JBizdirectoryproductsController@destroy');

//For Bizdirectory
Route::get('auth/all-biz', 'App\Http\Controllers\BizdirectoryController@index');
Route::post('auth/create-directory', 'App\Http\Controllers\BizdirectoryController@store');
Route::get('auth/biz-directory/{businessname}', 'App\Http\Controllers\JBizdirectoryController@show');
//Route::post('auth/update-product/{slug}', 'App\Http\Controllers\BizdirectoryproductsController@update');
Route::delete('auth/delete-biz/{businessname}', 'App\Http\Controllers\JBizdirectoryController@destroy');