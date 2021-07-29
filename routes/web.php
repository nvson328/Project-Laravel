<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

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
//Frontend
Route::get('/',[HomeController::class,'index']);
//Danh mục sản phẩM trang home
Route::get('danh-muc-san-pham/{id}',[CategoryProduct::class,'ListCategoryProduct']);
Route::get('danh-muc-thuong-hieu/{id}',[BrandController::class,'ListBrandProduct']);
Route::get('chi-tiet-san-pham/{id}',[ProductController::class,'DetailsProduct']);
//Backend
//Admin
Route::get('/admin',[AdminController::class,'login'])->name('adminlogin');
Route::post('/admin',[AdminController::class,'CheckLogin'])->name('checklogin');
Route::get('/admin-dashboard',[AdminController::class,'dashboard'])->name('adminpage');
Route::post('/admin-dashboard',[AdminController::class,'dashboard']);

//Category Product
Route::get('list-category-product',[CategoryProduct::class,'ListCategory']);
Route::get('unactive-category/{id}',[CategoryProduct::class,'UnactiveCategory']);
Route::get('active-category/{id}',[CategoryProduct::class,'ActiveCategory']);
Route::get('add-category-product',[CategoryProduct::class,'FormCategory']);
Route::post('add-category-product',[CategoryProduct::class,'AddCategory'])->name('addcategory');
Route::get('edit-category-product/{id}',[CategoryProduct::class,'FormEditCategory']);
Route::post('edit-category-product/{id}',[CategoryProduct::class,'EditCategory'])->name('editcategory');
Route::get('delete-category/{id}',[CategoryProduct::class,'DeleteCategory']);

//Product
Route::get('list-product',[ProductController::class,'ListProduct']);
Route::get('add-product',[ProductController::class,'FormProduct']);
Route::post('add-product',[ProductController::class,'AddProduct'])->name('addproduct');
Route::get('edit-product/{id}',[ProductController::class,'FormEditProduct']);
Route::post('edit-product/{id}',[ProductController::class,'EditProduct'])->name('editproduct');
Route::get('delete-product/{id}',[ProductController::class,'DeleteProduct'])->name('delete');
Route::get('unactive-product/{id}',[ProductController::class,'UnactiveProduct']);
Route::get('active-product/{id}',[ProductController::class,'ActiveProduct']);

//Brand Product
Route::get('list-brand',[BrandController::class,'ListBrand']);
Route::get('unactive-brand/{id}',[BrandController::class,'UnactiveBrand']);
Route::get('active-brand/{id}',[BrandController::class,'ActiveBrand']);
Route::get('add-brand',[BrandController::class,'FormBrand']);
Route::post('add-brand',[BrandController::class,'AddBrand'])->name('addbrand');
Route::get('edit-brand/{id}',[BrandController::class,'FormEditBrand']);
Route::post('edit-brand/{id}',[BrandController::class,'EditBrand'])->name('editbrand');
Route::get('delete-brand/{id}',[BrandController::class,'DeleteBrand']);

//Cart-use package
Route::post('/update-qty',[CartController::class,'UpdateQty']);
Route::get('/show-cart',[CartController::class,'ShowCart']);//Route cho Package Shopping cart
Route::post('/save-cart',[CartController::class,'SaveCart']);
Route::get('/delete-cart/{rowId}',[CartController::class,'DeleteCart']);
Route::get('/gio-hang',[CartController::class,'gio_hang']);//Route cho cart dùng ajax

//Cart-ajax
Route::post('/update-cart-ajax',[CartController::class,'UpdateCartAjax']);
Route::get('/delete-cart-ajax/{session_id}',[CartController::class,'DeleteCartAjax']);
Route::post('/add-cart-ajax',[CartController::class,'add_cart_ajax']);//Cart ajax


//Checkout
Route::get('login-checkout',[CheckoutController::class,'LoginCheckout']);
Route::get('logout-checkout',[CheckoutController::class,'LogoutCheckout']);
Route::post('add-customer',[CheckoutController::class,'AddCustomer']);
Route::post('login-customer',[CheckoutController::class,'LoginCustomer']);
Route::get('checkout',[CheckoutController::class,'Checkout']);
Route::post('save-checkout',[CheckoutController::class,'SaveCheckout']);
Route::get('payment',[CheckoutController::class,'Payment']);
