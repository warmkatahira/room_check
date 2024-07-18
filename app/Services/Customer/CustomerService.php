<?php

namespace App\Services\Customer;

// モデル
use App\Models\Customer;

class CustomerService
{
    // セッションを削除
    public function deleteSession()
    {
        // セッションを削除
        session()->forget([
            'search_base_id',
        ]);
        return;
    }

    // セッションに検索条件を格納
    public function setSearchCondition($request)
    {
        // trueなら検索が実行されているので、検索条件をセット
        if($request->search_enter){
            // 検索条件をセッションにを格納
            session(['search_base_id' => $request->search_base_id]);
        }
        return;
    }

    // 検索結果を取得
    public function getSearchResult()
    {
        // 荷主をセット
        $customers = Customer::query();
        // 拠点の条件がある場合
        if (session('search_base_id') != null) {
            $customers = $customers->where('customers.base_id', session('search_base_id'));
        }
        return $customers->orderBy('customers.base_id', 'asc')->orderBy('customer_code', 'asc')->paginate(20);
    }

    // 荷主を追加
    public function createCustomer($request){
        Customer::create([
            'customer_code' => $request->customer_code,
            'customer_category' => $request->customer_category,
            'customer_name' => $request->customer_name,
            'base_id' => $request->base_id,
        ]);
        return;
    }

    // 荷主を更新
    public function updateCustomer($request){
        Customer::where('customer_code', $request->customer_code)->update([
            'customer_category' => $request->customer_category,
            'customer_name' => $request->customer_name,
            'base_id' => $request->base_id,
        ]);
        return;
    }

    // 荷主を削除
    public function deleteCustomer($request){
        Customer::where('customer_code', $request->customer_code)->delete();
        return;
    }
}