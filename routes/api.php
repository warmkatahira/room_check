<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// +-+-+-+-+-+-+-+- Progress +-+-+-+-+-+-+-+-
use App\Http\Controllers\ProgressPost\ProgressPostController;

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
