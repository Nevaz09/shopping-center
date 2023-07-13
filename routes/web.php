<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'Frontend\FrontendController@index');
Route::get('category', 'Frontend\FrontendController@category');
Route::get('view-category/{slug}', 'Frontend\FrontendController@viewCategory');
Route::get('view-product/{category_slug}/{product_slug}', 'Frontend\FrontendController@viewProduct')->name('category/');
Route::post('add-cart', 'Frontend\CartController@addProduct');
Route::post('delete-cartItem', 'Frontend\CartController@deleteProduct');
Route::post('update-cartItem', 'Frontend\CartController@updateProduct');
Route::post('add-wishlist', 'Frontend\WishlistController@addWishlist');
Route::post('delete-wishlistItem', 'Frontend\WishlistController@deleteWishlistItem');
Route::get('load-cart', 'Frontend\CartController@cartcount');
Route::get('load-wishlist', 'Frontend\WishlistController@wishlistcount');
Route::get('load-pesanan', 'Frontend\UserController@pesanancount');

Route::middleware(['auth'])->group(function(){
    Route::post('proceed-pay', 'Frontend\CheckoutController@payment');
    
    Route::post('add-ratting', 'Frontend\RatingController@addRating');
    
    // Route::post('review/{$product_slug/userreview}', 'Frontend\ReviewController@indexReview');
    Route::post('add-review/', 'Frontend\ReviewController@addReview');

    Route::get('wishlist', 'Frontend\WishlistController@index');

    Route::group(['auth'=>'cart'], function(){
        Route::get('cart', 'Frontend\CartController@viewCart');
    });
    Route::group(['auth'=>'checkout'], function(){
        Route::get('checkout', 'Frontend\CheckoutController@index');
        Route::post('place-order', 'Frontend\CheckoutController@placeOrder');
    });
    Route::group(['auth' =>'user'], function(){
        Route::get('my-orders', 'Frontend\UserController@index');
        Route::get('view-order/{id}', 'Frontend\UserController@view');
    });
    
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => ['auth', 'isAdmin']], function(){
//     Route::get('/dashboard', function(){
//         return view('admin.dashboard');
//     });
// });
// Route::middleware(['auth', 'isAdmin'])->group(function(){
//     Route::get('/dashboard', function(){
//         return view('admin.index');;
//     });
// });

Route::middleware(['auth', 'isAdmin'])->group(function(){
    Route::group(['isAdmin'=>'category'], function(){
        Route::get('dashboard', 'Admin\FrontendController@index');
        Route::get('categories', 'Admin\CategoryController@index');
        Route::get('add-category', 'Admin\CategoryController@add')->name('add-category');
        Route::post('insert-category', 'Admin\CategoryController@insert');
        Route::get('edit-category/{id}', 'Admin\CategoryController@edit');
        Route::put('update-category/{id}', 'Admin\CategoryController@update');
        Route::get('destroy-category/{id}', 'Admin\CategoryController@destroy');
        Route::post('destroyallcategory', 'Admin\CategoryController@destroyall')->name('destroyallcategory');    
    });

    Route::group(['isAdmin'=>'product'], function(){
        Route::get('products', [ProductController::class, 'index']);
        Route::get('add-product', [ProductController::class, 'add'])->name('add-product');
        Route::post('insert-product', [ProductController::class, 'insert']);
        Route::get('edit-product/{id}', [ProductController::class, 'edit']);
        Route::put('update-product/{id}', [ProductController::class, 'update']);
        Route::get('destroy-product/{id}', [ProductController::class, 'destroy']);
        Route::post('destroyallproduct', [ProductController::class, 'destroyall'])->name('destroyallproduct');
    });
    Route::group(['isAdmin'=>'order'], function(){
        Route::get('orders',[OrderController::class, 'index']);
        Route::get('adminView-order/{id}',[OrderController::class, 'viewOrder']);
        Route::put('update-order/{id}',[OrderController::class, 'updateOrder']);
        Route::get('orders-history', [OrderController::class, 'orderHistory']);
    });

    Route::group(['isAdmin'=>'dashboard'], function(){
        Route::get('users', [DashboardController::class, 'users']);
        Route::get('view-users/{id}', [DashboardController::class, 'viewUsers']);
    });
});





