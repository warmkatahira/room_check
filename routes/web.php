<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// +-+-+-+-+-+-+-+- ウェルカム +-+-+-+-+-+-+-+-
use App\Http\Controllers\Welcome\WelcomeController;
// +-+-+-+-+-+-+-+- 進捗 +-+-+-+-+-+-+-+-
use App\Http\Controllers\Progress\ProgressController;
// +-+-+-+-+-+-+-+- 荷主 +-+-+-+-+-+-+-+-
use App\Http\Controllers\Customer\CustomerController;

// ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ Welcome ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    // -+-+-+-+-+-+-+-+-+-+-+-+ Welcome -+-+-+-+-+-+-+-+-+-+-+-+
    Route::controller(WelcomeController::class)->prefix('')->name('welcome.')->group(function(){
        Route::get('', 'index')->name('index');
    });

// ログインとステータスチェック
Route::middleware(['auth'])->group(function () {
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 進捗 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::controller(ProgressController::class)->prefix('progress')->name('progress.')->group(function(){
        Route::get('customer', 'customer')->name('customer');
        Route::get('base', 'base')->name('base');
        Route::get('tag', 'tag')->name('tag');
    });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 荷主 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::controller(CustomerController::class)->prefix('customer')->name('customer.')->group(function(){
        Route::get('', 'index')->name('index');
        Route::get('update', 'update_index')->name('update_index');
        Route::post('update', 'update')->name('update');
        Route::post('delete', 'delete')->name('delete');
    });
    
});

require __DIR__.'/auth.php';
