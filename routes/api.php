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

//Search feature
Route::get('auth/search-web/{keyword}', 'App\Http\Controllers\BizdirectoryController@searchAll');

//verify email
Route::post('auth/user/verify/{verification_code}', 'App\Http\Controllers\RegisterController@verifyUser');
//request password change code
Route::post('auth/password/reset-code/', 'App\Http\Controllers\RegisterController@requestPasswordChangeCode');
//change Password
Route::post('auth/create-new-password', 'App\Http\Controllers\RegisterController@changePassword');


    //recover password
Route::post('auth/recover-password', 'App\Http\Controllers\LoginController@recoverPassword');
Route::get('auth/login', 'App\Http\Controllers\LoginController@loginUser')->name('login');
Route::post('auth/login', 'App\Http\Controllers\LoginController@loginUser');
Route::post('auth/register', 'App\Http\Controllers\RegisterController@registerUser');
//Get all Posts
Route::get('auth/posts', 'App\Http\Controllers\PostController@index');
//get specific post by slug
Route::get('auth/blog/{slug}', 'App\Http\Controllers\PostController@show');
//Get all Jobs
Route::get('auth/jobs', 'App\Http\Controllers\JobsdirectoryController@index');
//get a specific job using job_slug
Route::get('auth/job/{job_slug}', 'App\Http\Controllers\JobsdirectoryController@showByJobSlug');
//get products for specific business using business_name_slug
Route::get('auth/products/{business_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@show');
//get single product using product_name_slug
Route::get('auth/product/{product_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@showProduct');
//get all Bizdirectory
Route::get('auth/all-biz', 'App\Http\Controllers\BizdirectoryController@index');
//get a specific biz directory using business_name_slug
Route::get('auth/biz-directory/{business_name_slug}', 'App\Http\Controllers\BizdirectoryController@showbiz');
//Get WorkingHours for a specific business using business_name_slug
Route::get('auth/all-worktime/{business_name_slug}', 'App\Http\Controllers\WorkingHoursController@index');
//For Secrets
Route::get('auth/all-secrets', 'App\Http\Controllers\SecretController@index');
Route::post('auth/create-new-secret', 'App\Http\Controllers\SecretController@store');
Route::get('auth/secret/{slug}', 'App\Http\Controllers\SecretController@show');
//get all post comments per page
Route::get('auth/post-comments/{page_slug}', 'App\Http\PostCommentsController@index');
//save secret comment for all users
Route::post('auth/secret-comments', 'App\Http\SecretCommentsController@store');
//get all secret-anonymous comments per page
Route::get('auth/secret-anonymous-comments/{page_slug}', 'App\Http\SecretCommentsController@index');
//get all biz-directory review comments per page
Route::get('auth/review-comments/{page_slug}', 'App\Http\DirectoryReviewsController@index');
//use business_name_slug to get all faqs for a particular user
Route::get('auth/all-faqs/{business_name_slug}', 'App\Http\Controllers\FaqsController@index');


Route::group([

    'middleware' => 'jwt.auth',

], function () {

    Route::get('auth/user', 'App\Http\Controllers\LoginController@me');
    Route::post('auth/logout', 'App\Http\Controllers\LoginController@logoutUser');
    //to register business name on the Users Table for the first time
    Route::post('auth/update-business-name/{email}', 'App\Http\Controllers\RegisterController@updateUserBiz');
    //upload user image
    Route::post('auth/update-user-image/{email}', 'App\Http\Controllers\RegisterController@updateUserImage');

    //following this tutorial: https://appdividend.com/2022/03/01/laravel-vue-chat-application/
    //https://morioh.com/p/045be6631506

    //chat list
    Route::get('/channels/{$currentuser}', 'App\Http\Controllers\ChatController@fetchChats');
    //chat messages
    Route::get('/getmessages/{$channel_number}', 'App\Http\Controllers\ChatController@fetchMessages');
    //store chat messages
    Route::post('/message', 'App\Http\Controllers\ChatController@store');


    Route::group(['middleware' => 'isPublisher'], function(){
        //create new post
    Route::post('auth/create-new-post', 'App\Http\Controllers\PostController@store');
    //update post by post's slug
    Route::post('auth/update-post/{slug}', 'App\Http\Controllers\PostController@update');
    //get posts for specific user by username
    Route::get('auth/posts/{username}', 'App\Http\Controllers\PostController@showByUsername');
    //choose category for post
    Route::get('auth/category-admin', 'App\Http\Controllers\CategoryController@index');

    });

    Route::group(['middleware' => 'isCommenter'], function(){
    //get all jobs using business_name_slug
    Route::get('auth/jobs/{business_name_slug}', 'App\Http\Controllers\JobsdirectoryController@show');
    //create new job
    Route::post('auth/create-new-job', 'App\Http\Controllers\JobsdirectoryController@store');
    //update a specific job using job_slug
    Route::post('auth/update-job/{job_slug}', 'App\Http\Controllers\JobsdirectoryController@update');
    //deele specific job using job_slug
    Route::post('auth/delete-job/{job_slug}', 'App\Http\Controllers\JobsdirectoryController@destroy');
    //create products for specific business
    Route::post('auth/create-directory-product', 'App\Http\Controllers\BizdirectoryproductsController@store');
    //update product using product_name_slug
    Route::post('auth/update-product/{product_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@update');
    //delete product using product_name_slug
    Route::delete('auth/delete-product/{product_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@destroy');
    //create new directory
    Route::post('auth/create-directory', 'App\Http\Controllers\BizdirectoryController@store');
    //update a specific biz directory
    Route::post('auth/update-directory/{business_name_slug}', 'App\Http\Controllers\BizdirectoryproductsController@update');
    //delete a specific directory
    Route::delete('auth/delete-directory/{business_name_slug}', 'App\Http\Controllers\BizdirectoryController@destroy');
    //create new faqs
    Route::post('auth/create-new-faq', 'App\Http\Controllers\FaqsController@store');
    //update faq by ID 
    Route::post('auth/update-faq/{id}', 'App\Http\Controllers\FaqsController@update');
    //delete faq by ID
    Route::delete('auth/delete-faq/{id}', 'App\Http\Controllers\FaqsController@destroy');
    //create new worktime
    Route::post('auth/create-new-worktime', 'App\Http\Controllers\WorkingHoursController@store');
    //update worktime using business_name_slug
    Route::post('auth/update-worktime/{business_name_slug}', 'App\Http\Controllers\WorkingHoursController@update');
    //delete worktime using business_name_slug
    Route::delete('auth/delete-worktime/{business_name_slug}', 'App\Http\Controllers\WorkingHoursController@destroy');
    //save post comment for logged-in user
    Route::post('auth/post-comments', 'App\Http\PostCommentsController@store');
    //save biz-directory review comment for logged-in user
    Route::post('auth/directory-comments', 'App\Http\DirectoryReviewsController@store');

});
    
    Route::group(['middleware' => 'isAdmin'], function(){
        //Get all Bizdirectoryproducts for admin and superadmin
    Route::get('auth/all-products', 'App\Http\Controllers\BizdirectoryproductsController@index');
    //Get all Faqs for admin and superadmin
    Route::get('auth/all-faqs-table', 'App\Http\Controllers\FaqsController@showAll');
    //get all worktime for admin
    Route::get('auth/worktime-admin', 'App\Http\Controllers\WorkingHoursController@showAll');
    //update and delete secret
    Route::post('auth/update-secret/{slug}', 'App\Http\Controllers\SecretController@update');
    Route::delete('auth/delete-secret/{slug}', 'App\Http\Controllers\SecretController@destroy');
    //create category
    Route::post('auth/create-category', 'App\Http\Controllers\CategoryController@store');
    Route::post('auth/delete-category/{id}', 'App\Http\Controllers\CategoryController@destroy');
    Route::post('auth/update-category/{id}', 'App\Http\Controllers\CategoryController@update');

        });
});

//get faq by ID when editing
//Route::get('auth/faq/{id}', 'App\Http\Controllers\FaqsController@show');



/*For WorkingHours
Route::get('auth/all-worktime', 'App\Http\Controllers\WorkingHoursController@index');
Route::post('auth/create-new-worktime', 'App\Http\Controllers\WorkingHoursController@store');
Route::get('auth/worktime/{slug}', 'App\Http\Controllers\WorkingHoursController@show');
Route::post('auth/update-worktime/{slug}', 'App\Http\Controllers\WorkingHoursController@update');
Route::delete('auth/delete-worktime/{slug}', 'App\Http\Controllers\WorkingHoursController@destroy');

*/





