<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    // オートインクリメント無効化
    public $incrementing = false;
    // 主キーカラムを変更
    protected $primaryKey = 'item_code';
    // 操作可能なカラムを定義
    protected $fillable = [
        'item_code',
        'item_name',
        'item_unit',
        'item_sort_order',
    ];
    // 全て取得
    public static function getAll()
    {
        return self::orderBy('item_sort_order', 'asc');
    }
    // 指定したレコードを取得
    public static function getSpecify($item_code)
    {
        return self::where('item_code', $item_code);
    }
}
