<?php

namespace App\Http\Controllers\ProgressPost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Progress;

class ProgressPostController extends Controller
{
    public function post(Request $request)
    {
        // 送信されてきたパラメータの進捗をテーブルから取得
        $progress = Progress::where('customer_code', $request->customer_code)
                ->where('item_code', $request->item_code);
        // 既に存在する進捗の場合
        if($progress->count() > 0){
            $progress->update([
                'progress_value' => $request->progress_value,
            ]);
        }
        // 存在しない進捗の場合
        if($progress->count() == 0){

        }
        return response()->json([
            "message" => "post record created"
        ], 201);
    }
}
