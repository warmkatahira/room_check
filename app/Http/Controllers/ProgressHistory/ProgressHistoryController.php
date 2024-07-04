<?php

namespace App\Http\Controllers\ProgressHistory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\Item;
// サービス
use App\Services\ProgressHistory\ProgressHistoryService;

class ProgressHistoryController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $ProgressHistoryService = new ProgressHistoryService;
        // セッションを削除
        $ProgressHistoryService->deleteSession();
        // セッションに検索条件を格納
        $ProgressHistoryService->setSearchCondition($request);
        // 検索結果を取得
        $progress_histories = $ProgressHistoryService->getSearchResult();
        // 荷主を取得
        $customers = Customer::orderBy('base_id', 'asc')->get();
        // 項目を取得
        $items = Item::getAll()->where('is_progress_history_add', 1)->get();
        return view('progress_history.index')->with([
            'progress_histories' => $progress_histories,
            'customers' => $customers,
            'items' => $items,
        ]);
    }
}