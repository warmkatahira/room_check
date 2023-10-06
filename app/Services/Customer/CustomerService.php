<?php

namespace App\Services\Customer;

// モデル
use App\Models\Customer;

class CustomerService
{
    // 荷主を追加
    public function createCustomer($request){
        Customer::create([
            'customer_code' => $request->customer_code,
            'customer_name' => $request->customer_name,
            'base_id' => $request->base_id,
        ]);
        return;
    }

    // 荷主を更新
    public function updateCustomer($request){
        Customer::where('customer_code', $request->customer_code)->update([
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