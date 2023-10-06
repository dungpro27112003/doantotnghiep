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

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);
        Route::get('home', [MainController::class, 'home']);

        Route::prefix('menus')->group(function (){
            Route::get('add',[MenuController::class,'create']);
            Route::post('add',[MenuController::class,'store']);
            Route::get('list',[MenuController::class,'index']);
            Route::get('edit/{menu}',[MenuController::class,'show']);
            Route::post('edit/{menu}',[MenuController::class,'update']);
            Route::DELETE('destroy',[MenuController::class,'destroy']);
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

        #Upload
        Route::post('upload/services',[UploadController::class,'store']);

        #Cart
        Route::get('customers',[App\Http\Controllers\Admin\CartController::class,'index']);
        Route::get('customers/view/{customer}',[App\Http\Controllers\Admin\CartController::class,'show']);
    });

    
});

Route::get('/',[MainController::class,'index']);
Route::post('/services/load-product', [MainController::class, 'loadProduct']);

Route::get('/danh-muc/{id}-{slug}.html',[App\Http\Controllers\MenuController::class,'index']);
Route::get('/san-pham/{id}-{slug}.html',[App\Http\Controllers\ProductController::class,'index']);

Route::post('/add-cart',[CartController::class,'index']);
Route::get('/carts',[CartController::class,'show']);
Route::post('/update-cart',[CartController::class,'update']);
Route::get('/carts/delete/{id}',[CartController::class,'remove']);
Route::post('/carts',[CartController::class,'addCart']);
