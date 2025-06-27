<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogsingleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
 Route::prefix('admin')->group(function () {
    // all your routes here


    Route::get('register', [RegisterController::class,'showregistrationform'])->name('admin.register');
    Route::post('register', [RegisterController::class,'register'])->name('admin.submit.register');
    Route::get('login', [LoginController::class,'showloginform'])->name('admin.login');
    Route::post('login', [LoginController::class,'login'])->name('admin.submit.login');
    Route::post('logout', [LoginController::class,'logout'])->name('admin.logout');

    // Protected admin routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/home', function () {
            return view('admin.dashboard');
        })->name('admin.home');

        Route::resource('categories', CategoriesController::class);
        Route::put('categories/restore/{id}', [CategoriesController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/force-delete/{id}', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');

        Route::resource('tags', TagsController::class);
        Route::put('tags/restore/{id}', [TagsController::class, 'restore'])->name('tags.restore');
        Route::delete('tags/force-delete/{id}', [TagsController::class, 'forceDelete'])->name('tags.forceDelete');

        Route::resource('posts', PostsController::class);
        Route::put('posts/restore/{id}', [PostsController::class, 'restore'])->name('posts.restore');
        Route::delete('posts/force-delete/{id}', [PostsController::class, 'forceDelete'])->name('posts.forceDelete');
    });
});

// Route::get('/front', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');
Route::get('categories', [CategoryController::class, 'index'])->name('frontend.categories');
Route::get('/posts', [PostController::class, 'index'])->name('frontend.post');
// For frontend post detail
Route::get('/post/{id}', [PostController::class, 'show'])->name('frontend.post-detail');
Route::get('/tags/post', [TagController::class, 'index'])->name('frontend.tags');
Route::get('/tags/post/{id}', [TagController::class, 'show'])->name('frontend.tag-post');

// ✅ Authenticated User Routes

// ✅ Protected dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/front', [FrontendController::class, 'index'])->name('frontend.index');
});

// For frontend post detail
// Route::get('/tags/post/{id}', [TagController::class, 'show'])->name('frontend.tag-post');


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/admin-login', function () {
//     return redirect()->route('admin.login');
// })->name('admin.redirect.login');

// });

Auth::routes();

