<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;
    // 主キーカラムを変更
    protected $primaryKey = 'base_id';
    // オートインクリメント無効化
    public $incrementing = false;
    // 操作可能なカラムを定義
    protected $fillable = [
        'base_id',
        'base_name',
    ];
    // 全て取得
    public static function getAll()
    {
        return self::orderBy('base_id', 'asc');
    }
    // customersテーブルとのリレーション
    public function customers()
    {
        return $this->hasMany(Customer::class, 'base_id', 'base_id');
    }
}
