<?php

namespace App\Http\Controllers\InformationPost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Information;
// その他
use Carbon\CarbonImmutable;

class InformationPostController extends Controller
{
    public function post(Request $request)
    {
        // 送信されてきたパラメータの情報をテーブルから取得
        $information = Information::where('customer_code', $request->customer_code)
                        ->where('label', $request->label);
        // 存在する場合
        if($information->count() > 0){
            // 値を更新
            $information->update([
                'value' => $request->value,
            ]);
        }
        // 存在しない場合
        if($information->count() == 0){
            // 情報を追加
            Information::create([
                'customer_code' => $request->customer_code,
                'label' => $request->label,
                'value' => $request->value,
                'unit' => $request->unit,
            ]);
        }
        return response()->json([
            "message" => 'OK',
        ], 201);
    }
}
