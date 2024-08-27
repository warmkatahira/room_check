<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// +-+-+-+-+-+-+-+- ウェルカム +-+-+-+-+-+-+-+-
use App\Http\Controllers\Welcome\WelcomeController;
// +-+-+-+-+-+-+-+- 進捗 +-+-+-+-+-+-+-+-
use App\Http\Controllers\Progress\ProgressController;
// +-+-+-+-+-+-+-+- 荷主 +-+-+-+-+-+-+-+-
use App\Http\Controllers\Customer\CustomerController;
// +-+-+-+-+-+-+-+- コメント +-+-+-+-+-+-+-+-
use App\Http\Controllers\Customer\CommentController;
// +-+-+-+-+-+-+-+- 項目 +-+-+-+-+-+-+-+-
use App\Http\Controllers\Item\ItemController;
// +-+-+-+-+-+-+-+- タグ +-+-+-+-+-+-+-+-
use App\Http\Controllers\Tag\TagController;
// +-+-+-+-+-+-+-+- 荷主タグ +-+-+-+-+-+-+-+-
use App\Http\Controllers\CustomerTag\CustomerTagController;
// +-+-+-+-+-+-+-+- ユーザー +-+-+-+-+-+-+-+-
use App\Http\Controllers\User\UserController;
// +-+-+-+-+-+-+-+- 権限 +-+-+-+-+-+-+-+-
use App\Http\Controllers\Role\RoleController;
// +-+-+-+-+-+-+-+- バージョン管理 +-+-+-+-+-+-+-+-
use App\Http\Controllers\VersionMgt\VersionMgtController;
// +-+-+-+-+-+-+-+- 進捗履歴 +-+-+-+-+-+-+-+-
use App\Http\Controllers\ProgressHistory\ProgressHistoryController;
// +-+-+-+-+-+-+-+- アラート設定 +-+-+-+-+-+-+-+-
use App\Http\Controllers\AlertSetting\AlertSettingController;

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
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 進捗履歴 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::controller(ProgressHistoryController::class)->prefix('progress_history')->name('progress_history.')->group(function(){
        Route::get('', 'index')->name('index');
        Route::get('download', 'download')->name('download');
    });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ アラート設定 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::controller(AlertSettingController::class)->prefix('alert_setting')->name('alert_setting.')->group(function(){
        Route::get('', 'index')->name('index');
        Route::get('create', 'create_index')->name('create_index');
        Route::post('create', 'create')->name('create');
        Route::get('update', 'update_index')->name('update_index');
        Route::post('update', 'update')->name('update');
        Route::post('delete', 'delete')->name('delete');
    });
    Route::controller(CommentController::class)->prefix('comment')->name('comment.')->group(function(){
        Route::post('ajax_comment_update', 'ajax_comment_update');
    });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ マスタ ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::middleware(['MasterOperationIsAvailable'])->group(function () {
        // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 荷主 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        Route::controller(CustomerController::class)->prefix('customer')->name('customer.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::get('create', 'create_index')->name('create_index');
            Route::post('create', 'create')->name('create');
            Route::get('update', 'update_index')->name('update_index');
            Route::post('update', 'update')->name('update');
            Route::post('delete', 'delete')->name('delete');
            Route::post('ajax_comment_update', 'ajax_comment_update');
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
    });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ バージョン管理 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::middleware(['MasterOperationIsAvailable'])->group(function () {
        // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ ユーザー ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        Route::controller(VersionMgtController::class)->prefix('version_mgt')->name('version_mgt.')->group(function(){
            Route::get('', 'index')->name('index');
        });
    });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 管理 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    Route::middleware(['ManagementOperationIsAvailable'])->group(function () {
        // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ ユーザー ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        Route::controller(UserController::class)->prefix('user')->name('user.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::get('update', 'update_index')->name('update_index');
            Route::post('update', 'update')->name('update');
        });
        // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 権限 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        Route::controller(RoleController::class)->prefix('role')->name('role.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::get('create', 'create_index')->name('create_index');
            Route::post('create', 'create')->name('create');
            Route::get('update', 'update_index')->name('update_index');
            Route::post('update', 'update')->name('update');
            Route::post('delete', 'delete')->name('delete');
        });
    });
});

require __DIR__.'/auth.php';
