<?php

namespace App\Services\AlertSetting;

// モデル
use App\Models\AlertSetting;

class AlertSettingService
{
    // アラート設定を追加
    public function createAlertSetting($request){
        AlertSetting::create([
            'alert_setting_name' => $request->alert_setting_name,
            'customer_code' => $request->customer_code,
            'item_code' => $request->item_code,
            'alert_time' => $request->alert_time,
            'alert_value' => $request->alert_value,
            'alert_message' => $request->alert_message,
        ]);
        return;
    }

    // アラート設定を更新
    public function updateAlertSetting($request){
        AlertSetting::where('alert_setting_id', $request->alert_setting_id)->update([
            'alert_setting_name' => $request->alert_setting_name,
            'customer_code' => $request->customer_code,
            'item_code' => $request->item_code,
            'alert_time' => $request->alert_time,
            'alert_value' => $request->alert_value,
            'alert_message' => $request->alert_message,
        ]);
        return;
    }

    // アラート設定を削除
    public function deleteAlertSetting($request){
        AlertSetting::where('alert_setting_id', $request->alert_setting_id)->delete();
        return;
    }
}