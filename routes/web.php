<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// +-+-+-+-+-+-+-+- ウェルカム +-+-+-+-+-+-+-+-
use App\Http\Controllers\WelcomeController;
// +-+-+-+-+-+-+-+- ログチェック +-+-+-+-+-+-+-+-
use App\Http\Controllers\LogCheckController;

// -+-+-+-+-+-+-+-+-+-+-+-+ ウェルカム -+-+-+-+-+-+-+-+-+-+-+-+
Route::controller(WelcomeController::class)->prefix('')->name('welcome.')->group(function(){
    Route::get('', 'index')->name('index');
});

// -+-+-+-+-+-+-+-+-+-+-+-+ ログチェック -+-+-+-+-+-+-+-+-+-+-+-+
Route::controller(LogCheckController::class)->prefix('log_check')->name('log_check.')->group(function(){
    Route::post('import', 'import')->name('import');
});

require __DIR__.'/auth.php';
