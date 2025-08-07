<?php
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request; // ✅ Correct
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogsingleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('welcome');
// });
      Route::get('excel', [UsersController::class,'import'])->name('users.import');
     Route::post('excel', [UsersController::class,'import_post'])->name('users.import');

Route::prefix('admin')->group(function () {
    Route::get('register', [RegisterController::class,'showregistrationform'])->name('admin.register');
    Route::post('register', [RegisterController::class,'register'])->name('admin.submit.register');
    Route::get('login', [LoginController::class,'showloginform'])->name('admin.login');
    Route::post('login', [LoginController::class,'login'])->name('admin.submit.login');
    Route::post('logout', [LoginController::class,'logout'])->name('admin.logout');
    // Shared dashboard
   // ✅ Admin dashboard access (Admin or Blogger)
Route::middleware(['admin.or.blogger'])->group(function () {

    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');

    // ✅ Blogger & Admin (posts)
    Route::middleware(['admin.or.blogger'])->group(function () {
        Route::resource('posts', PostsController::class);
        Route::put('posts/restore/{slug}', [PostsController::class, 'restore'])->name('posts.restore');
        Route::delete('posts/force-delete/{slug}', [PostsController::class, 'forceDelete'])->name('posts.forceDelete');
    });

    // ✅ Admin Only
    Route::middleware('role:admin,admin')->group(function () {
        Route::resource('categories', CategoriesController::class);
        Route::put('categories/restore/{slug}', [CategoriesController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/force-delete/{slug}', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::post('categoryimport', [CategoriesController::class,'import_category'])->name('categories.import'); 
    Route::post('export_categories', [CategoriesController::class,'export'])->name('categories.export');  

        Route::resource('tags', TagsController::class);
        Route::put('tags/restore/{slug}', [TagsController::class, 'restore'])->name('tags.restore');
        Route::delete('tags/force-delete/{slug}', [TagsController::class, 'forceDelete'])->name('tags.forceDelete');

        Route::resource('permissions', PermissionsController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('users', UsersController::class);

    Route::post('excel', [TagsController::class,'import_post'])->name('tags.import'); 
    Route::post('export_tags', [TagsController::class,'export'])->name('tags.export');  

        Route::resource('comments', CommentsController::class);
        Route::patch('posts/{slug}/approve', [PostsController::class, 'approve'])->name('admin.posts.approve');
          Route::get('/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
         Route::resource('products', ProductsController::class);
         Route::resource('orders', OrdersController::class);

    });
});
});

// Both Superadmin and Blogger can access posts
// Route::middleware(['auth:admin', 'role:blogger'])->group(function () {
//     Route::resource('posts', PostsController::class);
// });

// -----------------------------------------------------------------------------------------------------
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('frontend.index'); // or 'dashboard' or any other route for logged-in users
    } else {
        return redirect()->route('login'); // default Laravel login route
    }
});
Auth::routes(['verify' => true]);

// Public Route
Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');

// Protected Routes - Only for Logged-In & Verified Users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/front', [FrontendController::class, 'index'])->name('frontend.index');
Route::prefix('user')->name('user.')->group(function () {
    Route::resource('posts', PostController::class);
});
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

    Route::get('/authposts', [PostController::class, 'authindex'])->name('frontend.authpost');
    Route::get('/post/{slug}', [PostController::class, 'show'])->name('frontend.post-detail');

    Route::get('/categories', [CategoryController::class, 'index'])->name('frontend.categories');
// Add this route BEFORE the fallback post route

    Route::get('/tags/post', [TagController::class, 'index'])->name('frontend.tags');
    Route::get('/tags/post/{slug}', [TagController::class, 'show'])->name('frontend.tag-post');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');

Route::get('/posts/{slug}', [PostController::class, 'showPublic'])->name('frontend.posts.show');
 Route::get('/tags/post/{slug}', [TagController::class, 'show'])->name('frontend.tag-post');
// For slug binding
Route::get('post/{post:slug}/products', [ProductController::class, 'showProducts'])->name('frontend.post.products');

    Route::put('/comments', [CommentController::class, 'store'])->name('comments.store');
       Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
   Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decreasequantity'])->name('cart.decrease');
Route::post('/cart/increase/{id}', [CartController::class, 'increasequantity'])->name('cart.increase');
Route::get('/checkout', [PaymentController::class, 'show'])->name('checkout.show');
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent'])->name('create.payment.intent');
Route::post('/checkout/process', [PaymentController::class, 'processCheckout'])->name('checkout.process');

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
