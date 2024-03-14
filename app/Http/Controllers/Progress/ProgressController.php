<?php

namespace App\Http\Controllers\Progress;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// サービス
use App\Services\Progress\ProgressService;

class ProgressController extends Controller
{
    public function customer()
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        // 荷主毎で集計した進捗を取得
        $data = $ProgressService->getProgressByCustomer();
        return view('progress.customer')->with([
            'data' => $data,
        ]);
    }

    public function base()
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        // 拠点毎で集計した進捗を取得
        $data = $ProgressService->getProgressByBase();
        return view('progress.base')->with([
            'data' => $data,
        ]);
    }

    public function tag()
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        // タグ毎で集計した進捗を取得
        $data = $ProgressService->getProgressByTag();
        return view('progress.tag')->with([
            'data' => $data,
        ]);
    }
}
