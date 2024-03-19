<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    // 主キーカラムを変更
    protected $primaryKey = 'tag_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'tag_name',
        'tag_sort_order',
    ];
    // 全て取得
    public static function getAll()
    {
        return self::orderBy('tag_sort_order', 'asc');
    }
    // 指定したレコードを取得
    public static function getSpecify($tag_id)
    {
        return self::where('tag_id', $tag_id);
    }
    // customersテーブルとのリレーション(中間テーブル用)
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_tag', 'tag_id', 'customer_code');
    }
}
