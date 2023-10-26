<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/items', 'App\Http\Controllers\MarketplaceController@searchItems');
Route::get('/getCategoryLists', 'App\Http\Controllers\MarketplaceController@getCategoryList');
Route::get('/fetchConditionsList', 'App\Http\Controllers\MarketplaceController@fetchConditionsList');
Route::get('/mostRecent', 'App\Http\Controllers\MarketplaceController@mostRecentMain');
Route::get('/getNewToken', 'App\Http\Controllers\ApiController@getNewtoken');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/addItemMarketplace', 'App\Http\Controllers\MarketplaceController@submitAddItem')->name('addItemMarketplace');
    Route::delete('/deleteUserItem', 'App\Http\Controllers\MarketplaceController@deleteUserItem')->name('deleteUserItem');
    Route::post('/editProfile', 'App\Http\Controllers\ProfileController@updateProfile')->name('updateProfile');
    Route::get('/getUserItem',  'App\Http\Controllers\MarketplaceController@getUserItem')->name('getUserItem');
    Route::post('/updateDataForm','App\Http\Controllers\MarketplaceController@updateDataForm')->name('updateDataForm');
    Route::post('/updateOrderRating','App\Http\Controllers\ProfileController@updateOrderRating')->name('updateOrderRating');
});
Route::get('/admin/users', 'App\Http\Controllers\AdminController@getUsers');
Route::get('/admin/transactions', 'App\Http\Controllers\AdminController@getTransactions');
Route::get('/admin/items', 'App\Http\Controllers\AdminController@getItems');
Route::get('/admin/reviews', 'App\Http\Controllers\AdminController@getReviews');

Route::post('/admin/submitTransaction', 'App\Http\Controllers\AdminController@submitTransaction');
Route::post('/admin/submitUsers', 'App\Http\Controllers\AdminController@submitUsers');
Route::post('/admin/submitItem', 'App\Http\Controllers\AdminController@submitItem');
Route::post('/admin/submitReview', 'App\Http\Controllers\AdminController@submitReview');

Route::delete('/admin/deleteUser', 'App\Http\Controllers\AdminController@deleteUser');
Route::delete('/admin/deleteTransaction', 'App\Http\Controllers\AdminController@deleteTransaction');
Route::delete('/admin/deleteItem', 'App\Http\Controllers\AdminController@deleteItem');
Route::delete('/admin/deleteReview', 'App\Http\Controllers\AdminController@deleteReview');


