<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth.custom', 'admin.custom'])->group(function() {
    Route::resource('cars', 'CarsController')->except(['index', 'show']);
    Route::resource('products', 'ProductController')->except(['index', 'show']);
    Route::resource('contacts', 'ContactController')->except(['store']);

});

Route::post('contacts','ContactController@store');

Route::get('setlocale/{locale}',function($lang){
    $lang = $lang == 'en' ? 'en' : 'ar';
    \Session::put('locale',$lang);
    return redirect()->back();   
});

Route::post('/orders','OrderController@store');
Route::get('/orders','OrderController@index');
Route::get('/cars','CarsController@index');
Route::get('/cars/{id}','CarsController@show');
Route::get('/products','ProductController@index');
Route::get('/products/{id}','ProductController@show')->name('product_view');

Route::middleware('guest.custom')->group(function(){
    Route::get('/login', 'AuthenticationController@loginPage')->name('loginPage');
    Route::post('/login', 'AuthenticationController@login')->name('loginPost');
    Route::get('/register', 'AuthenticationController@registerPage')->name('regPage');
    Route::post('/register', 'AuthenticationController@register')->name('regPost');

});

Route::get('/admin', function() {
    return view('admin');
})->name('admin');
Route::post('/logout','AuthenticationController@logout')->name('logout');
Route::get('/', 'LandingController')->name('home');
// Route::get('/productView',function(){
//     return view('product.view');
// })->name('product_view');

Route::get('/checkout',function(){
    return view('payment.checkout');
})->name('checkout');
Route::get('/adminProducts',function(){
    return view('product.admin_products');
})->name('admin_products');

Route::get('/adminCars',function(){
    return view('product.admin_cars');
})->name('admin_cars');

Route::get('/checkoutSuccessful',function(){
    return view('payment.checkoutSuccessful');
})->name('checkoutSuccessful');

Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaymentController@payWithPaypal',));
Route::post('paypal', array('as' => 'paypal','uses' => 'PaymentController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'status','uses' => 'PaymentController@getPaymentStatus',));

Route::get('/contactUs',function(){
    return view('admin.contact_us');
})->name('contactUs');

Route::get('/userOrders',function(){
    return view('orders.user_orders');
})->name('userOrders');