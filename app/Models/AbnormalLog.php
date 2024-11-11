<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbnormalLog extends Model
{
    use HasFactory;
    // 主キーカラムを変更
    protected $primaryKey = 'abnormal_log_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'access_date',
        'access_user_name',
        'abnormal_note',
    ];
}
