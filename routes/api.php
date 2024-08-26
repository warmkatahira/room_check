<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// +-+-+-+-+-+-+-+- Progress +-+-+-+-+-+-+-+-
use App\Http\Controllers\ProgressPost\ProgressPostController;
// +-+-+-+-+-+-+-+- Information +-+-+-+-+-+-+-+-
use App\Http\Controllers\InformationPost\InformationPostController;
// +-+-+-+-+-+-+-+- Shipping Confirmed +-+-+-+-+-+-+-+-
use App\Http\Controllers\ShippingConfirmedPost\ShippingConfirmedPostController;

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

// -+-+-+-+-+-+-+-+-+-+-+-+ 進捗更新 -+-+-+-+-+-+-+-+-+-+-+-+
Route::controller(ProgressPostController::class)->prefix('progress_post')->name('progress_post.')->group(function(){
    Route::post('', 'post')->name('post');
});

// -+-+-+-+-+-+-+-+-+-+-+-+ 情報更新 -+-+-+-+-+-+-+-+-+-+-+-+
Route::controller(InformationPostController::class)->prefix('information_post')->name('information_post.')->group(function(){
    Route::post('', 'post')->name('post');
});

// -+-+-+-+-+-+-+-+-+-+-+-+ 出荷確定日更新 -+-+-+-+-+-+-+-+-+-+-+-+
Route::controller(ShippingConfirmedPostController::class)->prefix('shipping_confirmed_post')->name('shipping_confirmed_post.')->group(function(){
    Route::post('', 'post')->name('post');
});
