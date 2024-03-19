<?php

namespace App\Services\User;

// モデル
use App\Models\User;

class UserService
{
    // ユーザーを更新
    public function updateUser($request){
        User::where('user_id', $request->user_id)->update([
            'role_id' => $request->role_id,
            'status' => $request->status,
        ]);
        return;
    }
}