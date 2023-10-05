<?php

namespace App\Http\Controllers\Progress;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
// サービス
use App\Services\Progress\ProgressService;

class ProgressController extends Controller
{
    public function customer()
    {
        // 荷主を全て取得(進捗関連データも同時に取得しておく)
        $customers = Customer::with('progresses')->orderBy('customers.updated_at', 'desc')->get();
        return view('progress.customer')->with([
            'customers' => $customers,
        ]);
    }

    public function base()
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        // 営業所毎で集計した進捗を取得
        $base_progress_arr = $ProgressService->getProgressByBase();
        return view('progress.base')->with([
            'base_progress_arr' => $base_progress_arr,
        ]);
    }

    public function tag()
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        // タグ毎で集計した進捗を取得
        $tag_progress_arr = $ProgressService->getProgressByTag();
        return view('progress.tag')->with([
            'tag_progress_arr' => $tag_progress_arr,
        ]);
    }
}
