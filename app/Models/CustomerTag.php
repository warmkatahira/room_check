<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTag extends Model
{
    use HasFactory;
    // テーブル名を定義
    protected $table = 'customer_tag';
    // 主キーカラムを変更
    protected $primaryKey = 'customer_tag_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'customer_code',
        'tag_id',
    ];
    // progressesテーブルとのリレーション
    public function progresses()
    {
        return $this->hasMany(Progress::class, 'customer_code', 'customer_code')
                ->join('items', 'items.item_code', 'progresses.item_code')
                ->orderBy('items.item_sort_order', 'asc');
    }
}
