<?php

namespace App\Http\Controllers\ProgressPost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Progress;
use App\Models\Customer;
use App\Models\SystemVersionManagement;
// その他
use Carbon\CarbonImmutable;

class ProgressPostController extends Controller
{
    public function post(Request $request)
    {
        // 送信されてきたパラメータの進捗をテーブルから取得
        $progress = Progress::where('customer_code', $request->customer_code)
                        ->where('item_code', $request->item_code);
        // 存在する場合
        if($progress->count() > 0){
            // 値を更新
            $progress->update([
                'progress_value' => $request->progress_value,
            ]);
        }
        // 存在しない場合
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
        // PC名を送信されてきている場合のみ実施
        if(!is_null($request->pc_name)){
            // system_nameからシステム名とバージョンを分割
            $system_name_explode = explode('_v', $request->system_name);
            // 荷主コードとPC名の組合せをテーブルから取得
            $system_version_management = SystemVersionManagement::where('customer_code', $request->customer_code)
                                            ->where('pc_name', $request->pc_name);
            // 存在する場合
            if($system_version_management->count() > 0){
                // 値を更新
                $progress->update([
                    'system_name' => $system_name_explode[0],
                    'system_version' => $system_name_explode[1],
                ]);
            }
            // 存在しない場合
            if($system_version_management->count() == 0){
                // 進捗を追加
                SystemVersionManagement::create([
                    'customer_code' => $request->customer_code,
                    'pc_name' => $request->pc_name,
                    'system_name' => $system_name_explode[0],
                    'system_version' => $system_name_explode[1],
                ]);
            }
        }
        return response()->json([
            "message" => 'OK',
        ], 201);
    }
}
