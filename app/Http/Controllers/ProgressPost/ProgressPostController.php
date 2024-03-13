<?php

namespace App\Http\Controllers\ProgressPost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Progress;
use App\Models\Customer;
// その他
use Carbon\CarbonImmutable;

class ProgressPostController extends Controller
{
    public function post(Request $request)
    {
        /* dd($request->params); */
        foreach($request->params as $param){
            dd($param);
        }


        // 送信されてきたパラメータの進捗をテーブルから取得
        $progress = Progress::where('customer_code', $request->customer_code)
                ->where('item_code', $request->item_code);
        // 既に存在する進捗の場合
        if($progress->count() > 0){
            // 値を更新
            $progress->update([
                'progress_value' => $request->progress_value,
            ]);
        }
        // 存在しない進捗の場合
        if($progress->count() == 0){
            // 進捗を追加
            Progress::create([
                'customer_code' => $request->customer_code,
                'item_code' => $request->item_code,
                'progress_value' => $request->progress_value,
            ]);
        }
        // 荷主のupdated_atを更新
        Customer::where('customer_code', $request->customer_code)->update([
            'updated_at' => CarbonImmutable::now(),
        ]);
        return response()->json([
            "message" => $request->params
        ], 201);
    }
}
