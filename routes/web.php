<?php

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

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Route::get('/', function () {
//    return view('welcome');
//});


// HOME PAGE


Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Index PAGE
Route::get('/','IndexController@index');

// CATEGORY / LISTING PAGE
Route::get('products/{url}','ProductsController@products');

//Product Detail Page
Route::get('product/{id}','ProductsController@product');

//Get Product Attribute PRice
Route::any('/get-product-price','ProductsController@getProductPrice');

// Add to Cart Route
Route::match(['get','post'],'/add-cart','ProductsController@addtocart');

// Cart Page
Route::match(['get','post'],'/cart','ProductsController@cart');

// Delete item from cart
Route::match(['get','post'],'/cart/delete-product/{id}','ProductsController@deleteCartProduct');

// Update quantity in cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

// Checkout Page
Route::match(['get','post'],'/checkout','ProductsController@checkout');


//Get Product Attribute PRice
Route::any('/get-product-price','ProductsController@getProductPrice');

///******  USER ROUTES ********************

// Users Login/Register Page
Route::get('/login-register','UsersController@userLoginRegister');

//FORGOT PASSWORD
Route::match(['GET','POST'],'/forgot-password', 'UsersController@forgotPassword');

// Users Register Form Submit
Route::post('/user-register','UsersController@register');

// Check if User already exists
Route::match(['GET','POST'],'/check-email', 'UsersController@checkEmail');

// Users LOGIN
Route::post('/user-login','UsersController@login');


// **** ROUTES AFTER LOGIN
Route::group(['middleware'=>['frontlogin']],function(){
    // Users ACCOUNT PAGE
    Route::match(['GET','POST'],'account','UsersController@account');
    Route::post('/check-user-pwd','UsersController@chkUserPassword');
    Route::post('/update-user-pwd','UsersController@updatePassword');
    Route::match(['get','post'],'/checkout','ProductsController@checkout');
    Route::match(['get','post'],'/order-review','ProductsController@orderReview');
    Route::match(['get','post'],'/place-order','ProductsController@placeOrder');

    Route::match(['get','post'],'/thanks','ProductsController@thanks');
    Route::match(['get','post'],'/paypal','ProductsController@paypal');

    Route::get('/user-logout','UsersController@logout');

    Route::get('/orders','ProductsController@userOrders');
    //User Orders Products Page
    Route::get('/orders/{id}','ProductsController@userOrderDetails');

});

//**********************************//

Route::group(['middleware' => ['adminauth']], function(){

    Route::get('/admin/dashboard','AdminController@dashboard');
    Route::get('/admin/settings','AdminController@settings');
    Route::get('/admin/check-pwd','AdminController@chkPassword');
    Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

    //Categories Routes(Admin)
    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
    Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
    Route::get('/admin/view-categories','CategoryController@viewCategories');

    //Products Routes(Admin)
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::get('/admin/view-products','ProductsController@viewProducts');
    Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
    Route::match(['get','post'],'/admin/delete-product/{id}','ProductsController@deleteProduct');
    Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteAltImage');

    //Products Attributes Routes
    Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttribute');
    Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAttributes');
    Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');
    Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addImages');


    //Admin Banners Routes
    Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
    Route::get('/admin/view-banners','BannersController@viewBanners');
    Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
    Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');
    Route::get('/logout', 'AdminController@logout')->middleware('adminauth');

    //Admin Orders Routes
    Route::get('/admin/view-orders/','ProductsController@viewOrders');
    //Admin Orders Routes
    Route::get('/admin/view-order/{id}','ProductsController@viewOrderDetails');
    //Update Order Status
    Route::post('/admin/update-order-status/','ProductsController@updateOrderStatus');

} );


/// CONTACT PAGE
Route::match(['GET','POST'],'/page/contact','CmsController@contact');




