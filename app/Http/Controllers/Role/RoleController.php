<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Role;
// サービス
use App\Services\Role\RoleService;
// リクエスト
use App\Http\Requests\RoleCreateUpdateRequest;

class RoleController extends Controller
{
    public function index()
    {
        // 権限を全て取得
        $roles = Role::getAll()->get();
        return view('role.index')->with([
            'roles' => $roles,
        ]);
    }

    public function create_index()
    {
        return view('role.create')->with([
        ]);
    }

    public function create(RoleCreateUpdateRequest $request)
    {
        // インスタンス化
        $RoleService = new RoleService;
        // 権限を追加
        $RoleService->createRole($request);
        return redirect()->route('role.index')->with([
            'alert_type' => 'success',
            'alert_message' => '権限追加が完了しました。',
        ]);
    }

    public function update_index(Request $request)
    {
        // 権限を取得
        $role = Role::getSpecify($request->role_id)->first();
        return view('role.update')->with([
            'role' => $role,
        ]);
    }

    public function update(RoleCreateUpdateRequest $request)
    {
        // インスタンス化
        $RoleService = new RoleService;
        // 権限を更新
        $RoleService->updateRole($request);
        return redirect()->route('role.index')->with([
            'alert_type' => 'success',
            'alert_message' => '権限更新が完了しました。',
        ]);
    }

    public function delete(Request $request)
    {
        // インスタンス化
        $RoleService = new RoleService;
        // 紐付いているユーザーがいれば中断
        if(Role::getSpecify($request->role_id)->first()->users->count() > 0){
            return redirect()->back()->with([
                'alert_type' => 'error',
                'alert_message' => '紐付いているユーザーがいる為、削除できませんでした。',
            ]);
        }
        // 権限を削除
        $RoleService->deleteRole($request);
        return redirect()->route('role.index')->with([
            'alert_type' => 'success',
            'alert_message' => '権限削除が完了しました。',
        ]);
    }
}
