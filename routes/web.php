<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// +-+-+-+-+-+-+-+- ウェルカム +-+-+-+-+-+-+-+-
use App\Http\Controllers\Welcome\WelcomeController;
// +-+-+-+-+-+-+-+- 進捗 +-+-+-+-+-+-+-+-
use App\Http\Controllers\Progress\ProgressController;
// +-+-+-+-+-+-+-+- 荷主 +-+-+-+-+-+-+-+-
use App\Http\Controllers\Customer\CustomerController;
// +-+-+-+-+-+-+-+- 項目 +-+-+-+-+-+-+-+-
use App\Http\Controllers\Item\ItemController;
// +-+-+-+-+-+-+-+- タグ +-+-+-+-+-+-+-+-
use App\Http\Controllers\Tag\TagController;
// +-+-+-+-+-+-+-+- 荷主タグ +-+-+-+-+-+-+-+-
use App\Http\Controllers\CustomerTag\CustomerTagController;
// +-+-+-+-+-+-+-+- ユーザー +-+-+-+-+-+-+-+-
use App\Http\Controllers\User\UserController;

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
        Route::get('create', 'create_index')->name('create_index');
        Route::post('create', 'create')->name('create');
        Route::get('update', 'update_index')->name('update_index');
        Route::post('update', 'update')->name('update');
        Route::post('delete', 'delete')->name('delete');
    });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 項目 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::controller(ItemController::class)->prefix('item')->name('item.')->group(function(){
        Route::get('', 'index')->name('index');
        Route::get('create', 'create_index')->name('create_index');
        Route::post('create', 'create')->name('create');
        Route::get('update', 'update_index')->name('update_index');
        Route::post('update', 'update')->name('update');
        Route::post('delete', 'delete')->name('delete');
    });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ タグ ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::controller(TagController::class)->prefix('tag')->name('tag.')->group(function(){
        Route::get('', 'index')->name('index');
        Route::get('create', 'create_index')->name('create_index');
        Route::post('create', 'create')->name('create');
        Route::get('update', 'update_index')->name('update_index');
        Route::post('update', 'update')->name('update');
        Route::post('delete', 'delete')->name('delete');
    });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 荷主タグ ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::controller(CustomerTagController::class)->prefix('customer_tag')->name('customer_tag.')->group(function(){
        Route::get('', 'index')->name('index');
        Route::get('update', 'update_index')->name('update_index');
        Route::post('update', 'update')->name('update');
    });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 荷主タグ ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::controller(UserController::class)->prefix('user')->name('user.')->group(function(){
        Route::get('', 'index')->name('index');
        Route::get('update', 'update_index')->name('update_index');
        Route::post('update', 'update')->name('update');
    });
    
});

require __DIR__.'/auth.php';
