<?php

namespace App\Http\Controllers\Progress;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\Progress\ProgressService;
use App\Services\Progress\ProgressAlertService;

class ProgressController extends Controller
{
    public function customer(Request $request)
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        $ProgressAlertService = new ProgressAlertService;
        // 荷主毎で集計した進捗を取得
        $data = $ProgressService->getProgressByCustomer($request);
        // アラート発報かどうかをチェック
        $data = $ProgressAlertService->checkAlert($data);
        // 出勤中人数を拠点毎に整理
        $working_info = $ProgressService->getWorkingInfo();
        // 拠点を全て取得
        $bases = Base::getAll()->get();
        return view('progress.customer')->with([
            'data' => $data,
            'working_info' => $working_info,
            'bases' => $bases,
        ]);
    }

    public function base()
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        // 拠点毎で集計した進捗を取得
        $data = $ProgressService->getProgressByBase();
        // 出勤中人数を拠点毎に整理
        $working_info = $ProgressService->getWorkingInfo();
        return view('progress.base')->with([
            'data' => $data,
            'working_info' => $working_info,
        ]);
    }

    public function tag()
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        // タグ毎で集計した進捗を取得
        $data = $ProgressService->getProgressByTag();
        // 出勤中人数を拠点毎に整理
        $working_info = $ProgressService->getWorkingInfo();
        return view('progress.tag')->with([
            'data' => $data,
            'working_info' => $working_info,
        ]);
    }
}
