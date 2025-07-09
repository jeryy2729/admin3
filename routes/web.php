<?php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request; // ✅ Correct
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogsingleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
Route::get('/', function () {
    return view('welcome');
});
 Route::prefix('admin')->group(function () {
    // all your routes here


    Route::get('register', [RegisterController::class,'showregistrationform'])->name('admin.register');
    Route::post('register', [RegisterController::class,'register'])->name('admin.submit.register');
    Route::get('login', [LoginController::class,'showloginform'])->name('admin.login');
    Route::post('login', [LoginController::class,'login'])->name('admin.submit.login');
    Route::post('logout', [LoginController::class,'logout'])->name('admin.logout');

    // Protected admin routes
    Route::middleware(['auth:admin'])->group(function () {
           Route::get('/home', [AdminController::class,'index'])->name('admin.home');

        // Route::get('/home', function () {
        //     return view('admin.dashboard');
        // })->name('admin.home');
       Route::put('categories/restore/{slug}', [CategoriesController::class, 'restore'])->name('categories.restore');
Route::delete('categories/force-delete/{slug}', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');
// Resource route last (respects getRouteKeyName => 'slug')
Route::resource('categories', CategoriesController::class);
   Route::put('tags/restore/{slug}', [TagsController::class, 'restore'])->name('tags.restore');
        Route::delete('tags/force-delete/{slug}', [TagsController::class, 'forceDelete'])->name('tags.forceDelete');
 Route::resource('tags', TagsController::class);
     
// Route::get('/comments', [CommentsController::class, 'index'])->name('comments.index');
        Route::resource('comments', CommentsController::class);

Route::get('/users', [UsersController::class, 'index'])->name('users.index');
 Route::put('posts/restore/{slug}', [PostsController::class, 'restore'])->name('posts.restore');
        Route::delete('posts/force-delete/{slug}', [PostsController::class, 'forceDelete'])->name('posts.forceDelete');
   Route::patch('posts/{slug}/approve', [PostsController::class, 'approve'])->name('admin.posts.approve');

        Route::resource('posts', PostsController::class);
       
    });
});

// -----------------------------------------------------------------------------------------------------
Auth::routes(['verify' => true]);

// Public Route
Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');

// Protected Routes - Only for Logged-In & Verified Users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/front', [FrontendController::class, 'index'])->name('frontend.index');
Route::prefix('user')->name('user.')->group(function () {
    Route::resource('posts', PostController::class);
});
    Route::get('/authposts', [PostController::class, 'authindex'])->name('frontend.authpost');

    Route::get('/post/{id}', [PostController::class, 'show'])->name('frontend.post-detail');

    Route::get('/categories', [CategoryController::class, 'index'])->name('frontend.categories');

    Route::get('/tags/post', [TagController::class, 'index'])->name('frontend.tags');
    Route::get('/tags/post/{id}', [TagController::class, 'show'])->name('frontend.tag-post');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/posts/{slug}', [PostController::class, 'showPublic'])->name('frontend.posts.show');
});


// 📢 Show notice if not verified
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// 📩 Email link verification
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // ✅ Marks email as verified
    return redirect('/front')->with('message', 'Your email has been verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// 🔁 Resend verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
