<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemVersionManagement extends Model
{
    use HasFactory;
    // 主キーカラムを変更
    protected $primaryKey = 'system_version_management_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'customer_code',
        'pc_name',
        'system_name',
        'system_version',
    ];
}
