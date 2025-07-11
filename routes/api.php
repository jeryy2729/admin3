<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/test',function(){
return('api working');
});
  Route::get('/posts', [FrontendController::class,'getAllposts']);
    Route::get('/category/{slug}', [CategoryController::class,'search']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

  Route::get('/users', [UserController::class,'index']);
