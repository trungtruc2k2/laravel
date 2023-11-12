<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;


//  Route::middleware('auth:sanctum')->get('\user', function (Request $request) {
//      return $request->user();
//  });
// Route::prefix('brand')->group-(function(){
//     Route::get('index',[BrandController::class,'index']);
//     Route::get('show/{id}',[BrandController::class,'show']);
//     Route::post('store',[BrandController::class,'store']);
//     Route::post('update/{id}',[BrandController::class,'update']);
//     Route::delete('destroy/{id}',[BrandController::class,'destroy']);
// });
Route::get('menu_list/{position}/{parent_id?}', [MenuController::class, 'menu_list']);
Route::get('slider_list/{position}', [SliderController::class, 'slider_list']);
Route::get('category_list/{parent_id?}', [CategoryController::class, 'category_list']);

Route::get('product_home/{limit}/{category_id?}', [ProductController::class, 'product_home']);
Route::get('product_all/{limit}', [ProductController::class, 'product_all']);
Route::get('product_category/{category_id}/{limit}', [ProductController::class, 'product_category']);
Route::get('product_brand/{brand_id}/{limit}', [ProductController::class, 'product_brand']);
Route::get('product_detail/{slug}', [ProductController::class, 'product_detail']);
Route::get('product_other/{id}/{limit}', [ProductController::class, 'product_other']);

Route::get('post_list/{limit}/{type}', [PostController::class, 'post_list']);
Route::get('post_all/{limit}/{page?}', [PostController::class, 'post_all']);
Route::get('post_topic/{topic_id}/{limit}/{page?}', [PostController::class, 'post_topic']);
Route::get('post_detail/{id}', [PostController::class, 'post_detail']);
Route::get('post_other/{id}/{limit}', [PostController::class, 'post_other']);

Route::get('brand/index', [BrandController::class, 'index']);
Route::get('brand/show/{id}', [BrandController::class, 'show']);
Route::post('brand/store', [BrandController::class, 'store']);
Route::post('brand/update/{id}', [BrandController::class, 'update']);
Route::delete('brand/destroy/{id}', [BrandController::class, 'destroy']);

Route::get('category/index', [CategoryController::class, 'index']);
Route::get('category/show/{id}', [CategoryController::class, 'show']);
Route::post('category/store', [CategoryController::class, 'store']);
Route::post('category/update/{id}', [CategoryController::class, 'update']);
Route::delete('category/destroy/{id}', [CategoryController::class, 'destroy']);

Route::get('product/index', [ProductController::class, 'index']);
Route::get('product/show/{id}', [ProductController::class, 'show']);
Route::post('product/store', [ProductController::class, 'store']);
Route::post('product/update/{id}', [ProductController::class, 'update']);
Route::delete('product/destroy/{id}', [ProductController::class, 'destroy']);

Route::get('menu/index', [MenuController::class, 'index']);
Route::get('menu/show/{id}', [MenuController::class, 'show']);
Route::post('menu/store', [MenuController::class, 'store']);
Route::post('menu/update/{id}', [MenuController::class, 'update']);
Route::delete('menu/destroy/{id}', [MenuController::class, 'destroy']);

Route::get('contact/index', [ContactController::class, 'index']);
Route::get('contact/show/{id}', [ContactController::class, 'show']);
Route::post('contact/store', [ContactController::class, 'store']);
Route::post('contact/update/{id}', [ContactController::class, 'update']);
Route::delete('contact/destroy/{id}', [ContactController::class, 'destroy']);

Route::get('order/index', [OrderController::class, 'index']);
Route::get('order/show/{id}', [OrderController::class, 'show']);
Route::post('order/store', [OrderController::class, 'store']);
Route::post('order/update/{id}', [OrderController::class, 'update']);
Route::delete('order/destroy/{id}', [OrderController::class, 'destroy']);

Route::get('slider/index', [SliderController::class, 'index']);
Route::get('slider/show/{id}', [SliderController::class, 'show']);
Route::post('slider/store', [SliderController::class, 'store']);
Route::post('slider/update/{id}', [SliderController::class, 'update']);
Route::delete('slider/destroy/{id}', [SliderController::class, 'destroy']);

Route::get('topic/index', [TopicController::class, 'index']);
Route::get('topic/show/{id}', [TopicController::class, 'show']);
Route::post('topic/store', [TopicController::class, 'store']);
Route::post('topic/update/{id}', [TopicController::class, 'update']);
Route::delete('topic/destroy/{id}', [TopicController::class, 'destroy']);

Route::get('user/index', [UserController::class, 'index']);
Route::get('user/show/{id}', [UserController::class, 'show']);
Route::post('user/store', [UserController::class, 'store']);
Route::post('user/update/{id}', [UserController::class, 'update']);
Route::delete('user/destroy/{id}', [UserController::class, 'destroy']);

Route::get('post/index', [PostController::class, 'index']);
Route::get('post/show/{id}', [PostController::class, 'show']);
Route::post('post/store', [PostController::class, 'store']);
Route::post('post/update/{id}', [PostController::class, 'update']);
Route::delete('post/destroy/{id}', [PostController::class, 'destroy']);
Route::get('post/{type}', [PostController::class, 'getPostsByType']);

// auth
Route::post('auth/login', [UserController::class, 'authLogin']);
Route::post('auth/register', [UserController::class, 'register']);
