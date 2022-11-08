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
//update post by post's slug
Route::post('auth/update-post/{slug}', 'App\Http\Controllers\PostController@update');
//get posts for specific user by username
Route::get('auth/posts/{username}', 'App\Http\Controllers\PostController@showByUsername');


//Get all Jobs
Route::get('auth/jobs', 'App\Http\Controllers\JobsdirectoryController@index');
//get all jobs using business_name_slug
Route::get('auth/jobs/{business_name_slug}', 'App\Http\Controllers\JobsdirectoryController@show');
Route::post('auth/create-new-job', 'App\Http\Controllers\JobsdirectoryController@store');
//get a specific job using job_slug
Route::get('auth/job/{job_slug}', 'App\Http\Controllers\JobsdirectoryController@showById');
//update a specific job using job_slug
Route::post('auth/update-job/{job_slug}', 'App\Http\Controllers\JobsdirectoryController@update');
//deele specific job using job_slug
Route::post('auth/delete-job/{job_slug}', 'App\Http\Controllers\JobsdirectoryController@destroy');

//Get all Bizdirectoryproducts for admin and superadmin
Route::get('auth/all-products', 'App\Http\Controllers\BizdirectoryproductsController@index');
//create products for specific business
Route::post('auth/create-directory-product', 'App\Http\Controllers\BizdirectoryproductsController@store');
//get products for specific business using business_name_slug
Route::get('auth/products/{business_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@show');
//update product using product_name_slug
Route::post('auth/update-product/{product_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@update');
//get single product using product_name_slug
Route::get('auth/product/{product_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@showProduct');
//delete product using product_name_slug
Route::delete('auth/delete-product/{product_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@destroy');

//get all Bizdirectory
Route::get('auth/all-biz', 'App\Http\Controllers\BizdirectoryController@index');
Route::post('auth/create-directory', 'App\Http\Controllers\BizdirectoryController@store');
//get a specific biz directory using business_name_slug
Route::get('auth/biz-directory/{business_name_slug}', 'App\Http\Controllers\BizdirectoryController@showbiz');
//update a specific biz directory
Route::post('auth/update-directory/{business_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@update');
//delete a specific directory
Route::delete('auth/delete-directory/{business_name_slug}', 'App\Http\Controllers\BizdirectoryController@destroy');

//For all Faqs for admin and superadmin
Route::get('auth/all-faqs-table', 'App\Http\Controllers\FaqsController@showAll');
//use business_name_slug to get all faqs for a particular user
Route::get('auth/all-faqs/{business_name_slug}', 'App\Http\Controllers\FaqsController@index');
//create new faqs
Route::post('auth/create-new-faq', 'App\Http\Controllers\FaqsController@store');
//get faq by ID when editing
//Route::get('auth/faq/{id}', 'App\Http\Controllers\FaqsController@show');
//update faq by ID 
Route::post('auth/update-faq/{id}', 'App\Http\Controllers\FaqsController@update');
//delete faq by ID
Route::delete('auth/delete-faq/{id}', 'App\Http\Controllers\FaqsController@destroy');


//Get WorkingHours for a specific business using business_name_slug
Route::get('auth/all-worktime/{business_name_slug}', 'App\Http\Controllers\WorkingHoursController@index');
Route::post('auth/create-new-worktime', 'App\Http\Controllers\WorkingHoursController@store');
//get all worktime for admin
Route::get('auth/worktime-admin', 'App\Http\Controllers\WorkingHoursController@showAll');
//update worktime using business_name_slug
Route::post('auth/update-worktime/{business_name_slug}', 'App\Http\Controllers\WorkingHoursController@update');
//delete worktime using business_name_slug
Route::delete('auth/delete-worktime/{business_name_slug}', 'App\Http\Controllers\WorkingHoursController@destroy');

/*For WorkingHours
Route::get('auth/all-worktime', 'App\Http\Controllers\WorkingHoursController@index');
Route::post('auth/create-new-worktime', 'App\Http\Controllers\WorkingHoursController@store');
Route::get('auth/worktime/{slug}', 'App\Http\Controllers\WorkingHoursController@show');
Route::post('auth/update-worktime/{slug}', 'App\Http\Controllers\WorkingHoursController@update');
Route::delete('auth/delete-worktime/{slug}', 'App\Http\Controllers\WorkingHoursController@destroy');

*/

//For Secrets
Route::get('auth/all-secrets', 'App\Http\Controllers\SecretController@index');
Route::post('auth/create-new-secret', 'App\Http\Controllers\SecretController@store');
Route::get('auth/secret/{slug}', 'App\Http\Controllers\SecretController@show');
Route::post('auth/update-secret/{slug}', 'App\Http\Controllers\SecretController@update');
Route::delete('auth/delete-secret/{slug}', 'App\Http\Controllers\SecretController@destroy');




