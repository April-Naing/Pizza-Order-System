<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//login
Route::redirect('/', 'loginPage');
Route::middleware(['admin_auth'])->group(function(){
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin.Category
    Route::middleware(['admin_auth'])->group(function(){

       Route::prefix('category')->group(function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
       });

       Route::prefix('admin')->group(function(){
        //password
        Route::get('password/changePage',[AdminController::class,'changePwPage'])->name('admin#changePwPage');
        Route::post('password/change',[AdminController::class,'passwordChange'])->name('admin#passwordChange');

        //profile
        Route::get('profile',[AdminController::class,'profile'])->name('admin#profile');
        Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
        Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

        //list
        Route::get('list',[AdminController::class,'list'])->name('admin#list');
        Route::get('delete/{id}',[ADminController::class,'delete'])->name('adminlist#delete');
        Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
        Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');
        Route::get('ajax/admin/changeRole',[AdminController::class,'ajaxChangeRole'])->name('admin#ajaxChangeRole');

        //order
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('order#list');
            Route::get('status/change',[OrderController::class,'statusChange'])->name('order#statusChange');
            Route::get('ajax/change/status',[OrderController::class,'changeStatus'])->name('order#changeStatus');
            Route::get('product/list/{orderCode}',[OrderController::class,'productList'])->name('order#productList');
        });

        //user
        Route::prefix('user')->group(function(){
            Route::get('list',[Admincontroller::class,'userList'])->name('admin#userList');
            Route::get('ajax/list',[AdminController::class,'ajaxUserList'])->name('admin#ajaxUserList');
        });

        //contact message
        Route::prefix('contact')->group(function(){
            Route::get('message/list',[AdminController::class,'messageList'])->name('admin#contactMessageList');
            Route::get('message/delete/{id}',[AdminController::class,'messageDelete'])->name('admin#messageDelete');
        });
    });

      Route::prefix('product')->group(function(){
        Route::get('list',[ProductController::class,'list'])->name('product#list');
        Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
        Route::post('create',[ProductController::class,'create'])->name('product#create');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
        Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
        Route::post('update',[ProductController::class,'update'])->name('product#update');
    });



    });


    //user.Category
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        // Route::get('home',function(){
        //     return view('user.main.home');
        // })->name('user#home');

        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[Usercontroller::class,'history'])->name('user#history');

        Route::prefix('password')->group(function(){
           Route::get('changePwPage',[UserController::class,'changePwPage'])->name('user#changePwPage');
           Route::post('changePw',[UserController::class,'changePw'])->name('user#changePw');
        });

        Route::prefix('pizza')->group(function(){
           Route::get('detail/{id}',[UserController::class,'detail'])->name('pizza#detail');
           Route::get('cartlist',[UserController::class,'cartList'])->name('user#cartList');
        });

        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });

        Route::prefix('contact')->group(function(){
            Route::get('page',[ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('submit',[ContactController::class,'contact'])->name('user#contact');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[Ajaxcontroller::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            Route::get('increase/viewcount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });
    });
});




