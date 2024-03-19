<?php

namespace App\Services\CustomerTag;

// モデル
use App\Models\Customer;

class CustomerTagService
{
    // 荷主タグを更新
    public function updateCustomerTag($request){
        // 設定するタグを格納する配列を初期化
        $tags = [];
        // タグの設定があれば取得
        if(!is_null($request->tag_id)){
            foreach($request->tag_id as $key => $tag){
                $tags[] = $key;
            }
        }
        // 同期
        Customer::where('customer_code', $request->customer_code)->first()->tags()->sync($tags);
        return;
    }
}