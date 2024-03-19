<?php

namespace App\Services\Role;

// モデル
use App\Models\Role;

class RoleService
{
    // 項目を追加
    public function createItem($request){
        Item::create([
            'item_code' => $request->item_code,
            'item_name' => $request->item_name,
            'item_unit' => $request->item_unit,
            'item_sort_order' => $request->item_sort_order,
        ]);
        return;
    }

    // 項目を更新
    public function updateItem($request){
        Item::where('item_code', $request->item_code)->update([
            'item_name' => $request->item_name,
            'item_unit' => $request->item_unit,
            'item_sort_order' => $request->item_sort_order,
        ]);
        return;
    }

    // 項目を削除
    public function deleteItem($request){
        Item::where('item_code', $request->item_code)->delete();
        return;
    }
}