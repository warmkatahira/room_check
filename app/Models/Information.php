<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    // テーブル名を定義
    protected $table = 'information';
    // 主キーカラムを変更
    protected $primaryKey = 'information_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'customer_code',
        'label',
        'value',
        'unit',
    ];
}
