<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // オートインクリメント無効化
    public $incrementing = false;
    // 主キーカラムを変更
    protected $primaryKey = 'customer_code';
    // 操作可能なカラムを定義
    protected $fillable = [
        'customer_code',
        'customer_name',
        'base_id',
        'last_shipping_confirmed_date',
    ];
    // 全て取得
    public static function getAll()
    {
        return self::orderBy('created_at', 'asc');
    }
    // 指定したレコードを取得
    public static function getSpecify($customer_code)
    {
        return self::where('customer_code', $customer_code);
    }
    // progressesテーブルとのリレーション
    public function progresses()
    {
        return $this->hasMany(Progress::class, 'customer_code', 'customer_code')
                ->join('items', 'items.item_code', 'progresses.item_code')
                ->orderBy('items.item_sort_order', 'asc');
    }
    // basesテーブルとのリレーション
    public function base()
    {
        return $this->belongsTo(Base::class, 'base_id', 'base_id');
    }
    // customer_tagsテーブルとのリレーション
    public function customer_tags()
    {
        return $this->hasMany(CustomerTag::class, 'customer_code', 'customer_code')
                ->join('tags', 'tags.tag_id', 'customer_tag.tag_id')
                ->orderBy('tag_sort_order', 'asc');
    }
    // tagsテーブルとのリレーション(中間テーブル用)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'customer_tag', 'customer_code', 'tag_id')->withTimeStamps();
    }
}
