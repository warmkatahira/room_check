<?php

namespace App\Services\Customer;

// モデル
use App\Models\Customer;

class CustomerService
{
    // 荷主を更新
    public function updateCustomer($request){
        Customer::where('customer_code', $request->customer_code)->update([
            'customer_name' => $request->customer_name,
        ]);
        return;
    }

    // 荷主を削除
    public function deleteCustomer($request){
        Customer::where('customer_code', $request->customer_code)->delete();
        return;
    }
}