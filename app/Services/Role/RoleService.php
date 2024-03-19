<?php

namespace App\Services\Role;

// モデル
use App\Models\Role;

class RoleService
{
    // 権限を追加
    public function createRole($request){
        Role::create([
            'role_name' => $request->role_name,
            'master_operation_is_available' => $request->master_operation_is_available,
            'management_operation_is_available' => $request->management_operation_is_available,
        ]);
        return;
    }

    // 権限を更新
    public function updateRole($request){
        Role::where('role_id', $request->role_id)->update([
            'role_name' => $request->role_name,
            'master_operation_is_available' => $request->master_operation_is_available,
            'management_operation_is_available' => $request->management_operation_is_available,
        ]);
        return;
    }

    // 権限を削除
    public function deleteRole($request){
        Role::where('role_id', $request->role_id)->delete();
        return;
    }
}