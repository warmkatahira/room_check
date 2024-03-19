<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    // 主キーカラムを変更
    protected $primaryKey = 'role_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'role_name',
        'role_operation_is_available',
        'user_operation_is_available',
        'base_operation_is_available',
        'customer_operation_is_available',
        'item_operation_is_available',
    ];
    // 全て取得
    public static function getAll()
    {
        return self::orderBy('role_id', 'asc');
    }
    // 指定したレコードを取得
    public static function getSpecify($role_id)
    {
        return self::where('role_id', $role_id);
    }
}
