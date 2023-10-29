<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ViewController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::get('/login' , function (){
    $user = User::find(1);
    return  $user->createToken("shop_test")->plainTextToken;
});

Route::get('/' , function (){
    $user = Auth::check();
    $user= User::find(1);
    Auth::login($user);
    dd($user);

});
Route::middleware('auth:sanctum' )->get('/profile' , function (){
    return \request()->user();
});





Route::get('blog/most-view' , [App\Http\Controllers\Api\BlogController::class , 'blogWithMostView']);
Route::get('blog/discuss' , [App\Http\Controllers\Api\BlogController::class , 'mostCommentBlog']);
Route::get('blog/popular' , [App\Http\Controllers\Api\BlogController::class , 'mostLikeBlog']);
Route::apiResource('blog' , BlogController::class)->parameter('blog' , 'blog:uuid');


Route::get('product/storage' , [App\Http\Controllers\Api\ProductController::class , 'storage']);
Route::get('product/discuss' , [App\Http\Controllers\Api\ProductController::class , 'mostCommentedProduct']);
Route::get('product/popular' , [App\Http\Controllers\Api\ProductController::class , 'mostLikedProduct']);
Route::get('product/most-view' , [App\Http\Controllers\Api\ProductController::class , 'mostViewedProduct']);
Route::get('product/expensive' , [App\Http\Controllers\Api\ProductController::class , 'morePriceProducts']);
Route::apiResource('product' , ProductController::class)->parameter('product' , 'product:uuid');

//Route::apiResource('product' , ProductController::class);
Route::apiResource('user' , UserController::class)->parameter('user'  , 'user:uuid');
Route::apiResource('media' , MediaController::class)->parameter('media' , 'media:uuid');
Route::apiResource('comment' , CommentController::class)->parameter('comment' , 'comment:uuid');
Route::apiResource('comment' , CommentController::class)->parameter('comment' , 'comment:uuid');
Route::apiResource('like' , LikeController::class);
Route::apiResource('view' , ViewController::class);


Route::get('basket\clear' , function (){
   resolve(\App\Repositories\Storage\StorageRepositoryInterface::class)->clear();
});

//Route::post('basket/store/{product}',[\App\Http\Controllers\Api\BasketController::class,'addToBasket']);
Route::apiResource('basket' , App\Http\Controllers\Api\BasketController::class);

Route::apiResource('cart' , App\Http\Controllers\Api\CartController::class);

