<?php

namespace App\Http\Controllers\ShippingConfirmedPost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
// その他
use Carbon\CarbonImmutable;

class ShippingConfirmedPostController extends Controller
{
    public function post(Request $request)
    {
        // 指定した荷主の出荷確定日時を更新
        Customer::where('customer_code', $request->customer_code)->update([
            'shipping_confirmed_at' => CarbonImmutable::now(),
        ]);
        return response()->json([
            "message" => 'OK',
        ], 201);
    }
}
