<?php

use Illuminate\Support\Facades\Route;

// website route
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopdetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChackoutController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;

// dashboard route
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrganicveggiesController;
use App\Http\Controllers\Admin\FeaturesController;
use App\Http\Controllers\Admin\OurorganicproductsController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\FreshorganicvegetablesController;
use App\Http\Controllers\Admin\BestsellerproductsController;
use App\Http\Controllers\Admin\CountersController;
use App\Http\Controllers\Admin\OurclientsayingController;







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


// Website routes

// home controller
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'Home')->name('home');
});

// shop controller
Route::controller(ShopController::class)->group(function () {
    Route::get('shop', 'Shop')->name('shop');
});

// shop-detail controller
Route::controller(ShopdetailController::class)->group(function () {
    Route::get('shop-detail', 'Shopdetail')->name('shop-detail');
});

// cart controller
Route::controller(CartController::class)->group(function () {
    Route::get('cart', 'Cart')->name('cart');
});

// chackout controller
Route::controller(ChackoutController::class)->group(function () {
    Route::get('chackout', 'Chackout')->name('chackout');
});

// testimonial controller
Route::controller(TestimonialController::class)->group(function () {
    Route::get('testimonial', 'Testimonial')->name('testimonial');
});

// contact controller
Route::controller(ContactController::class)->group(function () {
    Route::get('contact', 'Contact')->name('contact');
});


// Dashboard route

// admin-login controller
Route::controller(AuthController::class)->group(function () {
    Route::get('admin', 'Adminlogin')->name('admin');
    Route::post('admin-login', 'Login')->name('admin-login');
    Route::post('admin/logout', 'Logout')->name('logout');

});

// dashboard controller
Route::controller(DashboardController::class)->group(function () {
    Route::get('admin/dashboard', 'Dashboard')->name('dashboard');
});

// organic-veggies controller
Route::controller(OrganicveggiesController::class)->group(function () {
    Route::get('admin/organic-veggies', 'Organicveggies')->name('organic-veggies');
    Route::get('admin/add-organic-veggies', 'Addorganicveggies')->name('add-organic-veggies');
    Route::post('admin/add-store-organic-veggies', 'Addstoreorganicveggies')->name('add-store-organic-veggies');
    Route::get('admin/edit-organic-veggies/{Organicveggies_id}', 'Editorganicveggies')->name('edit-organic-veggies');
    Route::post('admin/edit-store-organic-veggies/{Organicveggies_id}', 'Editstoreorganicveggies')->name('edit-store-organic-veggies');
    Route::get('admin/delete-admin-organic-veggies/{Organicveggies_id}', 'Deleteorganicveggies')->name('delete-admin-organic-veggies');
});

// features controller
Route::controller(FeaturesController::class)->group(function () {
    Route::get('admin/features', 'Features')->name('features');
    Route::get('admin/add-features', 'Addfeatures')->name('add-features');
    Route::post('admin/add-store-features', 'Addstorefeatures')->name('add-store-features');
    Route::get('admin/edit-features/{features_id}', 'Editfeatures')->name('edit-features');
    Route::post('admin/edit-store-features/{features_id}', 'Editstorefeatures')->name('edit-store-features');
    Route::get('admin/delete-features/{features_id}', 'Deletefeatures')->name('delete-features');
});

// our-organic-products controllr
Route::controller(OurorganicproductsController::class)->group(function () {
    Route::get('admin/our-organic-products', 'Ourorganicproducts')->name('our-organic-products');
    Route::get('admin/add-our-organic-products', 'Addourorganicproducts')->name('add-our-organic-products');
    Route::post('admin/add-store-our-organic-products', 'Addstoreourorganicproducts')->name('add-store-our-organic-products');
    Route::get('admin/edit-our-organic-products/{ourorganicproducts_id}', 'Editourorganicproducts')->name('edit-our-organic-products');
    Route::post('admin/edit-store-our-organic-productd/{ourorganicproducts_id}', 'Editstoreourorganicproducts')->name('edit-store-our-organic-productd');
    Route::get('admin/delete-our-organic-products/{ourorganicproducts_id}', 'Deleteoourorganinproduncts')->name('delete-our-organic-products');
});

// facility controller
Route::controller(FacilityController::class)->group(function () {
    Route::get('admin/facility', 'Facility')->name('facility');
    Route::get('admin/add-facility', 'Addfacility')->name('add-facility');
    Route::post('admin/add-store-facility', 'Addstorefacility')->name('add-store-facility');
    Route::get('admin/edit-facility/{facility_id}', 'Editfacility')->name('edit-facility');
    Route::post('admin/edit-store-facility/{facility_id}', 'Editstorefacility')->name('edit-store-facility');
    Route::get('admin/delete-facility/{facility_id}', 'Deletefacility')->name('delete-facility');
});

// fresh-organic-vegetables controller 
Route::controller(FreshorganicvegetablesController::class)->group(function () {
    Route::get('admin/fresh-organic-vegetables', 'Freshorganicvegetables')->name('fresh-organic-vegetables');
    Route::get('admin/add-fresh-organic-vegetables', 'Addfreshorganicvegetables')->name('add-fresh-organic-vegetables');
    Route::post('admin/add-store-fresh-organic-vegetables', 'Addstorefreshorganicvegetables')->name('add-store-fresh-organic-vegetables');
    Route::get('admin/edit-fresh-organic-vegetables/{freshorganicvegetables_id}', 'Editfreshorganicvegetables')->name('edit-fresh-organic-vegetables');
    Route::post('admin/edit-store-fresh-organic-vegetables/{freshorganicvegetables_id}', 'Editstorefreshorganicvegetables')->name('edit-store-fresh-organic-vegetables');
    Route::get('admin/delete-fresh-organic-vegetables/{freshorganicvegetables_id}', 'Deletefreshorganicvegetables')->name('delete-fresh-organic-vegetables');
});

// best-seller-products controller
Route::controller(BestsellerproductsController::class)->group(function () {
    Route::get('admin/best-seller-products', 'Bestsellerproducts')->name('best-seller-products');
    Route::get('admin/add-best-seller-products', 'Addbestsellerproducts')->name('add-best-seller-products');
    Route::post('admin/add-store-best-seller-products', 'Addstorebestsellerproducts')->name('add-store-best-seller-products');
    Route::get('admin/edit-best-seller-products/{bestsellerproducts_id}', 'Editbestsellerproducts')->name('edit-best-seller-products');
    Route::post('admin/edit-store-best-seller-products/{bestsellerproducts_id}', 'Editstorebestsellerproducts')->name('edit-store-best-seller-products');
    Route::get('admin/delete-best-seller-products/{bestsellerproducts_id}', 'Deletebestsellerproducts')->name('delete-best-seller-products');
});

// counters controller
Route::controller(CountersController::class)->group(function () {
    Route::get('admin/counters', 'Counters')->name('counters');
    Route::get('admin/add-counters', 'Addcounters')->name('add-counters');
    Route::post('admin/add-store-counters', 'Addstorecounters')->name('add-store-counters');
    Route::get('admin/edit-counters/{counters_id}', 'Editcounters')->name('edit-counters');
    Route::post('admin/edit-store-counters/{counters_id}', 'Editstorecounters')->name('edit-store-counters');
    Route::get('admin/delete-counters/{counters_id}', 'Deletecounters')->name('delete-counters');
});

// our-client-saying controller
Route::controller(OurclientsayingController::class)->group(function () {
    Route::get('admin/our-client-saying', 'Ourclientsaying')->name('our-client-saying');
    Route::get('admin/add-our-client-saying', 'Addourclientsaying')->name('add-our-client-saying');
    Route::post('admin/add-store-our-client-saying', 'Addstoreourclientsaying')->name('add-store-our-client-saying');
    Route::get('admin/edit-our-client-saying/{ourclientsaying_id}', 'Editourclientsaying')->name('edit-our-client-saying');
    Route::post('admin/edit-store-our-client-saying/{ourclientsaying_id}', 'Editstoreourclientsaying')->name('edit-store-our-client-saying');
    route::get('admin/delete-our-client-saying/{ourclientsaying_id}', 'Deleteourclientsaying')->name('delete-our-client-saying');
});