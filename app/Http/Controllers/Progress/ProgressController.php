<?php

namespace App\Http\Controllers\Progress;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\KintaiKintai;
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
        // 現在の営業所毎の出勤人数を取得
        $employee_count = KintaiKintai::getCurrentWorkingEmployeesCountByBase();
        return view('progress.customer')->with([
            'data' => $data,
            'employee_count' => $employee_count,
        ]);
    }

    public function base()
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        // 拠点毎で集計した進捗を取得
        $data = $ProgressService->getProgressByBase();
        // 現在の営業所毎の出勤人数を取得
        $employee_count = KintaiKintai::getCurrentWorkingEmployeesCountByBase();
        return view('progress.base')->with([
            'data' => $data,
            'employee_count' => $employee_count,
        ]);
    }

    public function tag()
    {
        // インスタンス化
        $ProgressService = new ProgressService;
        // タグ毎で集計した進捗を取得
        $data = $ProgressService->getProgressByTag();
        // 現在の営業所毎の出勤人数を取得
        $employee_count = KintaiKintai::getCurrentWorkingEmployeesCountByBase();
        return view('progress.tag')->with([
            'data' => $data,
            'employee_count' => $employee_count,
        ]);
    }
}
