<?php

namespace App\Http\Controllers\CustomerTag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\CustomerTag;
use App\Models\Tag;
// サービス
use App\Services\CustomerTag\CustomerTagService;
// リクエスト
use App\Http\Requests\CustomerTagUpdateRequest;

class CustomerTagController extends Controller
{
    public function index()
    {
        // 荷主を取得
        $customers = Customer::with('customer_tags')->get();
        return view('customer_tag.index')->with([
            'customers' => $customers,
        ]);
    }

    public function update_index(Request $request)
    {
        // 荷主を取得
        $customer = Customer::getSpecify($request->customer_code)->with('customer_tags')->first();
        // タグを全て取得
        $tags = Tag::getAll()->get();
        return view('customer_tag.update')->with([
            'customer' => $customer,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request)
    {
        // インスタンス化
        $CustomerTagService = new CustomerTagService;
        // 荷主タグを更新
        $CustomerTagService->updateCustomerTag($request);
        return redirect()->route('customer_tag.index')->with([
            'alert_type' => 'success',
            'alert_message' => '荷主タグ更新が完了しました。',
        ]);
    }
}
