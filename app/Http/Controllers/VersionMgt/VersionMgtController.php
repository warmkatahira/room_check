<?php

namespace App\Http\Controllers\VersionMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\SystemVersionManagement;
use App\Models\Customer;

class VersionMgtController extends Controller
{
    public function index(Request $request)
    {
        // セッションを削除
        session()->forget(['search_customer_code']);
        // trueなら検索が実行されているので、検索条件をセット
        if($request->search_enter){
            session(['search_customer_code' => $request->search_customer_code]);
        }
        // クエリをセット
        $system_version_managements = SystemVersionManagement::query();
        // 荷主条件があれば検索
        if (session('search_customer_code') != null && session('search_customer_code') != 'all') {
            $system_version_managements = $system_version_managements->where('customer_code', session('search_customer_code'));
        }
        // 並び替えて取得
        $system_version_managements = $system_version_managements->orderBy('updated_at', 'desc')->get();
        // 荷主を取得
        $customers = Customer::orderBy('base_id', 'asc')->get();
        return view('version_mgt.index')->with([
            'system_version_managements' => $system_version_managements,
            'customers' => $customers,
        ]);
    }
}
