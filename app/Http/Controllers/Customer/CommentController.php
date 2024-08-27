<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;

class CommentController extends Controller
{
    public function ajax_comment_update(Request $request)
    {
        // コメントを更新
        Customer::getSpecify($request->customer_code)->update([
            'comment' => $request->comment,
        ]);
        // 結果を返す
        return response()->json();
    }
}
