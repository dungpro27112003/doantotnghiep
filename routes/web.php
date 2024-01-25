<?php


use App\Http\Controllers\Admin\HangController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\Users\AllUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\SearchProductController;
use App\Http\Controllers\UserController;
use App\Models\FavouriteModel;
use App\Http\Controllers\PriceDicountController;

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

Route::get('admin/users/login', [LoginController::class, 'index'])->name('loginAdmin');
Route::post('admin/users/login/store', [LoginController::class, 'store']);
Route::get('admin/users/logout', [LoginController::class, 'logout'])->name('logoutAdmin');

Route::middleware(['middleware'=>'role'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('/', [MainController::class, 'indexAdmin'])->name('indexAdmin');
        // Route::get('main', [MainController::class, 'index']);
        // Route::get('home', [MainController::class, 'home']);

        Route::prefix('menus')->group(function (){
            Route::get('add',[MenuController::class,'create']);
            Route::post('add',[MenuController::class,'store']);
            Route::get('list',[MenuController::class,'index'])->name('listMenu');
            Route::get('edit/{menu}',[MenuController::class,'show']);
            Route::post('edit/{menu}',[MenuController::class,'update']);
            Route::DELETE('destroy',[MenuController::class,'destroy'])->name('deleteMenu');
        });

        Route::prefix('products')->group(function(){
            Route::get('add',[ProductController::class,'create']);
            Route::post('add',[ProductController::class,'store']);
            Route::get('list',[ProductController::class,'index']);
            Route::get('edit/{product}',[ProductController::class,'show']);
            Route::post('edit/{product}',[ProductController::class,'update']);
            Route::DELETE('destroy',[ProductController::class,'destroy']);
        });

        Route::prefix('sliders')->group(function(){
            Route::get('add',[SliderController::class,'create']);
            Route::post('add',[SliderController::class,'store']);
            Route::get('list',[SliderController::class,'index']);
            Route::get('edit/{slider}',[SliderController::class,'show']);
            Route::post('edit/{slider}',[SliderController::class,'update']);
            Route::DELETE('destroy',[SliderController::class,'destroy']);
        });

        Route::prefix('hang')->group(function(){
            Route::get('add',[HangController::class,'create']);
            Route::post('add',[HangController::class,'store']);
            Route::get('list',[HangController::class,'index']);
            Route::get('edit/{hang}',[HangController::class,'show']);
            //->name('showedit');
            Route::post('edit/{hang}',[HangController::class,'update']);
            Route::DELETE('destroy',[HangController::class,'destroy']);
        });
        // Coupon
        Route::resource('coupon', CouponController::class);

        // Image product
        Route::resource('image',ImageProductController::class);

        #Upload
        Route::post('upload/services',[UploadController::class,'store']);

        #Cart
        Route::get('customers',[App\Http\Controllers\Admin\CartController::class,'index']);
        Route::get('customers/view/{id}',[App\Http\Controllers\Admin\CartController::class,'show']);
        // delete
        Route::post('/customer-delete',[App\Http\Controllers\Admin\CartController::class,'delete'])->name('deleteCustomer');

        // price discount
        Route::resource('discount',PriceDicountController::class);

        // all user
       
            Route::resource('alluser', AllUserController::class);
    });
});




Route::get('/',[MainController::class,'index'])->name('trangchu');
Route::post('/services/load-product', [MainController::class, 'loadProduct']);
Route::post('/load-product-fillter', [MainController::class, 'loadProductFillter'])->name('loadProductFillter');
// login 
// show page dang nhap and dang ky
Route::get('/dang-nhap',[UserController::class,'showlogin'])->name('login');
Route::get('/dang-xuat',[UserController::class,'logout'])->name('logout');
// dang nhap
Route::post('/dang-nhap-signin',[UserController::class,'signin'])->name('signin');
// dang ky
Route::post('/dang-nhap-signup',[UserController::class,'signup'])->name('signup');


    Route::get('/danh-muc/{id}-{slug}.html',[App\Http\Controllers\MenuController::class,'index']);
    Route::get('/san-pham/{id}-{slug}.html',[App\Http\Controllers\ProductController::class,'index'])->name('productDetail');

    Route::post('/add-cart',[CartController::class,'index'])->name('addtoCart');
    Route::get('/carts',[CartController::class,'show'])->name('showCart');
    Route::post('/update-cart',[CartController::class,'update'])->name('updateCart');
    Route::post('/carts/delete',[CartController::class,'remove'])->name('deleteCart');
    Route::post('/carts',[CartController::class,'addCart'])->name('addCart');
    // COUPON
    Route::post('/coupon',[CartController::class,'Coupon'])->name('checkCoupon');



    // page manager user
    Route::get('manager-user/{id?}',[UserController::class,'manager_user'])->name('managerUser');
    Route::post('/manager-user-overview',[UserController::class,'overview'])->name('overview');
    Route::post('/manager-user-history-order',[UserController::class,'history_order'])->name('historyOrder');
    Route::post('/manager-user-detail-order',[UserController::class,'detail_order'])->name('detailOrder');
    Route::post('/manager-user-favourite-order',[UserController::class,'page_product_like'])->name('favouriteOrder');
    Route::post('/manager-user-delete-favourite-order',[UserController::class,'delete_favourite'])->name('deleteFavouriteOrder');


    // favourite_product
    Route::post('/favourite-product',[FavouriteController::class,'favourite'])->name('favouriteProduct');

    // comment_product
    Route::post('/comment-product',[CommentController::class,'comment'])->name('commentProduct');

    // search product
    Route::get('/search-product',[SearchProductController::class,'search_product'])->name('searchProduct');
