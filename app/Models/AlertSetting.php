<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertSetting extends Model
{
    use HasFactory;
    // テーブル名を定義
    protected $table = 'alert_settings';
    // 主キーカラムを変更
    protected $primaryKey = 'alert_setting_id';
    // 操作可能なカラムを定義
    protected $fillable = [
        'alert_setting_name',
        'customer_code',
        'item_code',
        'alert_time',
        'alert_value',
        'alert_message',
    ];
    // customersテーブルとのリレーション
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_code', 'customer_code');
    }
    // itemテーブルとのリレーション
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_code', 'item_code');
    }
    // 全て取得
    public static function getAll()
    {
        return self::orderBy('alert_setting_id', 'asc');
    }
    // 指定したレコードを取得
    public static function getSpecify($alert_setting_id)
    {
        return self::where('alert_setting_id', $alert_setting_id);
    }
}
