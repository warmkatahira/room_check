<?php

namespace App\Http\Controllers\ShippingConfirmedPost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\Progress;
use App\Models\ProgressHistory;
// その他
use Carbon\CarbonImmutable;

class ShippingConfirmedPostController extends Controller
{
    public function post(Request $request)
    {
        // 指定した荷主の出荷確定日時を更新
        Customer::where('customer_code', $request->customer_code)->update([
            'shipping_confirmed_at' => CarbonImmutable::now(),
        ]);
        // 進捗履歴テーブルに追加する情報を取得
        $progresses = Progress::where('customer_code', $request->customer_code)
                        ->join('items', 'items.item_code', 'progresses.item_code')
                        ->where('is_progress_history_add', 1)
                        ->get();
        // 進捗の分だけループ処理
        foreach($progresses as $progress){
            // レコードを追加
            ProgressHistory::create([
                'date' => CarbonImmutable::now()->format('Y-m-d'),
                'customer_code' => $request->customer_code,
                'item_code' => $progress->item_code,
                'progress_value' => $progress->progress_value,
            ]);
        }
        return response()->json([
            "message" => 'OK',
        ], 201);
    }
}
