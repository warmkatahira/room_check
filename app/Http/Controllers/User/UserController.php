<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\User;
use App\Models\Role;
// サービス
use App\Services\User\UserService;
// リクエスト
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        // ユーザーを全て取得
        $users = User::getAll()->get();
        return view('user.index')->with([
            'users' => $users,
        ]);
    }

    public function update_index(Request $request)
    {
        // ユーザーを取得
        $user = User::getSpecify($request->user_id)->first();
        // 権限を全て取得
        $roles = Role::getAll()->get();
        return view('user.update')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UserUpdateRequest $request)
    {
        // インスタンス化
        $UserService = new UserService;
        // ユーザーを更新
        $UserService->updateUser($request);
        return redirect()->route('user.index')->with([
            'alert_type' => 'success',
            'alert_message' => 'ユーザー更新が完了しました。',
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
