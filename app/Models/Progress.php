<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    // テーブル名を定義
    protected $table = 'progresses';
    // 主キーカラムを変更
    protected $primaryKey = 'progress_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'customer_code',
        'item_code',
        'progress_value',
    ];
    // itemテーブルとのリレーション
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_code', 'item_code');
    }
}
