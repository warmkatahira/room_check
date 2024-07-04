<?php

namespace App\Services\ProgressHistory;

// モデル
use App\Models\ProgressHistory;
// 列挙
use App\Enums\ProgressRatioEnum;
// その他
use Carbon\CarbonImmutable;

class ProgressHistoryService
{
    // セッションを削除
    public function deleteSession()
    {
        // セッションを削除
        session()->forget([
            'search_date_from',
            'search_date_to',
            'search_customer_code',
            'search_item_code',
        ]);
        return;
    }

    // セッションに検索条件を格納
    public function setSearchCondition($request)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($request->search_enter)){
            session(['search_date_from' => CarbonImmutable::now()->toDateString()]);
            session(['search_date_to' => CarbonImmutable::now()->toDateString()]);
        }
        // trueなら検索が実行されているので、検索条件をセット
        if($request->search_enter){
            // 検索条件をセッションにを格納
            session(['search_date_from' => $request->search_date_from]);
            session(['search_date_to' => $request->search_date_to]);
            session(['search_customer_code' => $request->search_customer_code]);
            session(['search_item_code' => $request->search_item_code]);
        }
        return;
    }

    // 検索結果を取得
    public function getSearchResult()
    {
        // 日付条件を適用
        $progress_histories = ProgressHistory::whereDate('date', '>=', session('search_date_from'))
                                ->whereDate('date', '<=', session('search_date_to'));
        // 荷主コードの条件がある場合
        if (session('search_customer_code') != null) {
            $progress_histories = $progress_histories->where('customer_code', session('search_customer_code'));
        }
        // 項目の条件がある場合
        if (session('search_item_code') != 0) {
            $progress_histories = $progress_histories->where('item_code', session('search_item_code'));
        }
        // ページネーションと並び替えを実施
        return $progress_histories->orderBy('date', 'asc')->orderBy('customer_code', 'asc')->orderBy('item_code', 'asc')->paginate(50);
    }
}