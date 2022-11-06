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
Route::post('auth/update-business-name/{email}', 'App\Http\Controllers\RegisterController@updateUserBiz');


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
Route::get('auth/products/{slug}', 'App\Http\Controllers\BizdirectoryproductsController@show');
//Route::post('auth/update-product/{slug}', 'App\Http\Controllers\BizdirectoryproductsController@update');
Route::get('auth/product/{productname}', 'App\Http\Controllers\BizdirectoryproductsController@showProduct');
Route::delete('auth/delete-product/{productname}', 'App\Http\Controllers\BizdirectoryproductsController@destroy');

//For Bizdirectory
Route::get('auth/all-biz', 'App\Http\Controllers\BizdirectoryController@index');
Route::post('auth/create-directory', 'App\Http\Controllers\BizdirectoryController@store');
Route::get('auth/biz-directory/{slug}', 'App\Http\Controllers\BizdirectoryController@showbiz');
Route::post('auth/update-directory/{slug}', 'App\Http\Controllers\BizdirectoryproductsController@update');
Route::delete('auth/delete-biz/{slug}', 'App\Http\Controllers\BizdirectoryController@destroy');

//For Faqs
Route::get('auth/all-faqs', 'App\Http\Controllers\FaqsController@index');
Route::post('auth/create-new-faq', 'App\Http\Controllers\FaqsController@store');
Route::get('auth/faq/{id}', 'App\Http\Controllers\FaqsController@show');
Route::post('auth/update-post/{id}', 'App\Http\Controllers\FaqsController@update');
Route::delete('auth/delete-faq/{id}', 'App\Http\Controllers\FaqsController@destroy');


//For WorkingHours
Route::get('auth/all-worktime/{businessname}', 'App\Http\Controllers\WorkingHoursController@index');
Route::post('auth/create-new-worktime', 'App\Http\Controllers\WorkingHoursController@store');
//not needed Route::get('auth/worktime/{businessname}', 'App\Http\Controllers\WorkingHoursController@show');
Route::post('auth/update-worktime/{businessname}', 'App\Http\Controllers\WorkingHoursController@update');
Route::delete('auth/delete-worktime/{businessname}', 'App\Http\Controllers\WorkingHoursController@destroy');

//For WorkingHours
Route::get('auth/all-worktime', 'App\Http\Controllers\WorkingHoursController@index');
Route::post('auth/create-new-worktime', 'App\Http\Controllers\WorkingHoursController@store');
Route::get('auth/worktime/{slug}', 'App\Http\Controllers\WorkingHoursController@show');
Route::post('auth/update-worktime/{slug}', 'App\Http\Controllers\WorkingHoursController@update');
Route::delete('auth/delete-worktime/{slug}', 'App\Http\Controllers\WorkingHoursController@destroy');

//For Secrets
Route::get('auth/all-secrets', 'App\Http\Controllers\SecretController@index');
Route::post('auth/create-new-secret', 'App\Http\Controllers\SecretController@store');
Route::get('auth/secret/{slug}', 'App\Http\Controllers\SecretController@show');
Route::post('auth/update-secret/{slug}', 'App\Http\Controllers\SecretController@update');
Route::delete('auth/delete-secret/{slug}', 'App\Http\Controllers\SecretController@destroy');




