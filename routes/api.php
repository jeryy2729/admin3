<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;


use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/test',function(){
return('api working');
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
  Route::get('/posts', [FrontendController::class,'getAllposts']);
    Route::get('/categories', [FrontendController::class,'getAllcategories']);
       Route::get('/category/{slug}', [CategoryController::class,'search']);
              Route::get('category/{slug}/posts', [CategoryController::class,'getpostsbycategory']);
              Route::get('tag/{slug}/posts', [TagController::class,'getpostsbytag']);
        Route::get('/tags', [FrontendController::class,'getAlltags']);
Route::middleware('auth:sanctum')->post('/storeposts', [PostController::class, 'store']);

  Route::get('/users', [UserController::class,'index']);
