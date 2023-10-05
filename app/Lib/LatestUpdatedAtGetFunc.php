<?php

namespace App\Lib;

// モデル
use App\Models\Progress;

class LatestUpdatedAtGetFunc
{
    // 指定した荷主の進捗で最新の更新日付を取得
    public static function get($customer_code)
    {
        $progress = Progress::where('customer_code', $customer_code)
                        ->orderBy('updated_at', 'desc')
                        ->first();
        return $progress->updated_at;
    }
}