<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DatabaseTestController;
use App\Http\Controllers\LoginController;
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
// WebPages

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/error', function () {
    return view('error');
})->name('error');

//logins
Route::post('/register', 'App\Http\Controllers\RegisterController@store')->name('registerChecker');
Route::post('/login', 'App\Http\Controllers\LoginController@loginService')->name('LoginService');
Route::middleware(['auth'])->group(function () {
    Route::get('/getNewToken', 'App\Http\Controllers\ApiController@getNewtoken')->name('GetNewApiToken');
    Route::get('/marketplace', function () {
        return view('marketplace');
    })->name('marketplace');
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/addItem', function () {
        return view('additem');
    })->name('additem');
    Route::post('/ajax/logout', 'App\Http\Controllers\LoginController@ajaxLogout')->name('ajax.logout');
    Route::get('/marketplace/{id}', 'App\Http\Controllers\MarketplaceController@ShowItemPage')->name('ItemPage');
});

// admin side
Route::get('/admin', function(){
   return view('admin');
})->name('AdminLogin');
Route::post('/admin', 'App\Http\Controllers\AdminAuthController@Login');
//admin auth group
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Update the view name here
    })->name('admin.dashboard');
});
    // Add more admin-specific routes as needed
