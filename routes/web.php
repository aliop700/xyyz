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
    Route::resource('products', 'ProductsController')->except(['index', 'show']);

});

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
