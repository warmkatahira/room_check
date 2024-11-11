<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;
    // 主キーカラムを変更
    protected $primaryKey = 'access_log_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'access_date',
        'access_user_name',
        'access_user_id',
        'access_user_code',
        'access_door_name',
        'access_door_id',
        'access_action',
        'access_device_type',
    ];
}
