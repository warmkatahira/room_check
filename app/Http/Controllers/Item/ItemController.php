<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Item;
// サービス
use App\Services\Item\ItemService;
// リクエスト
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;

class ItemController extends Controller
{
    public function index()
    {
        // 項目を全て取得
        $items = Item::getAll()->get();
        return view('item.index')->with([
            'items' => $items,
        ]);
    }

    public function create_index()
    {
        return view('item.create')->with([
        ]);
    }

    public function create(ItemCreateRequest $request)
    {
        // インスタンス化
        $ItemService = new ItemService;
        // 項目を追加
        $ItemService->createItem($request);
        return redirect()->route('item.index')->with([
            'alert_type' => 'success',
            'alert_message' => '項目追加が完了しました。',
        ]);
    }

    public function update_index(Request $request)
    {
        // 荷主を取得
        $item = Item::getSpecify($request->item_code)->first();
        return view('item.update')->with([
            'item' => $item,
        ]);
    }

    public function update(ItemUpdateRequest $request)
    {
        // インスタンス化
        $ItemService = new ItemService;
        // 項目を更新
        $ItemService->updateItem($request);
        return redirect()->route('item.index')->with([
            'alert_type' => 'success',
            'alert_message' => '項目更新が完了しました。',
        ]);
    }

    public function delete(Request $request)
    {
        // インスタンス化
        $ItemService = new ItemService;
        // 項目を削除
        $ItemService->deleteItem($request);
        return redirect()->route('item.index')->with([
            'alert_type' => 'success',
            'alert_message' => '項目削除が完了しました。',
        ]);
    }
}
