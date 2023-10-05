<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\Base;
// サービス
use App\Services\Customer\CustomerService;

class CustomerController extends Controller
{
    public function index()
    {
        // 荷主を全て取得
        $customers = Customer::join('bases', 'bases.base_id', 'customers.base_id')->orderBy('base_sort_order', 'asc')->get();
        return view('customer.index')->with([
            'customers' => $customers,
        ]);
    }

    public function update_index(Request $request)
    {
        // 荷主を取得
        $customer = Customer::getSpecify($request->customer_code)->first();
        // 営業所を全て取得
        $bases = Base::getAll()->get();
        return view('customer.update')->with([
            'customer' => $customer,
            'bases' => $bases,
        ]);
    }

    public function update(Request $request)
    {
        // インスタンス化
        $CustomerService = new CustomerService;
        // 荷主を更新
        $CustomerService->updateCustomer($request);
        return redirect()->route('customer.index')->with([
            'alert_type' => 'success',
            'alert_message' => '荷主更新が完了しました。',
        ]);
    }

    public function delete(Request $request)
    {
        // インスタンス化
        $CustomerService = new CustomerService;
        // 荷主を削除
        $CustomerService->deleteCustomer($request);
        return redirect()->route('customer.index')->with([
            'alert_type' => 'success',
            'alert_message' => '荷主削除が完了しました。',
        ]);
    }
}
