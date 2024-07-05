<?php

namespace App\Services\Item;

// モデル
use App\Models\Item;

class ItemService
{
    // 項目を追加
    public function createItem($request){
        Item::create([
            'item_code' => $request->item_code,
            'item_name' => $request->item_name,
            'item_unit' => $request->item_unit,
            'item_sort_order' => $request->item_sort_order,
            'is_progress_history_add' => $request->is_progress_history_add,
        ]);
        return;
    }

    // 項目を更新
    public function updateItem($request){
        Item::where('item_code', $request->item_code)->update([
            'item_name' => $request->item_name,
            'item_unit' => $request->item_unit,
            'item_sort_order' => $request->item_sort_order,
            'is_progress_history_add' => $request->is_progress_history_add,
        ]);
        return;
    }

    // 項目を削除
    public function deleteItem($request){
        Item::where('item_code', $request->item_code)->delete();
        return;
    }
}