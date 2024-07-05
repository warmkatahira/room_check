<?php

namespace App\Services\Progress;

// モデル
use App\Models\AlertSetting;
// その他
use Carbon\CarbonImmutable;

class ProgressAlertService
{
    // アラート発報かどうかをチェック
    public function checkAlert($data)
    {
        // 現在の時刻を取得
        $nowTime = CarbonImmutable::now()->toTimeString();
        // 進捗の分だけループ処理
        foreach($data['progress_arr'] as $key => $progress_arr){
            // アラート発報の判別を行う変数を初期化
            $alert = false;
            $alert_message_arr = [];
            // アラート設定を取得
            $alert_settings = AlertSetting::where('customer_code', $progress_arr['customer_code'])->get();
            // 設定があれば処理を継続
            if($alert_settings->count() > 0){
                // 設定の分だけループ処理
                foreach($alert_settings as $alert_setting){
                    // 設定の項目が進捗に存在すれば処理を継続
                    if(isset($progress_arr['item'][$alert_setting->item_code])){
                        // チェックに必要な項目を変数にセット
                        $progress_value = $progress_arr['item'][$alert_setting->item_code]['value'];
                        $alert_time = $alert_setting->alert_time;
                        $alert_value = $alert_setting->alert_value;
                        $alert_message = $alert_setting->alert_message;
                        // 現在の時刻がアラート発報時刻を過ぎているかつ、現在の値がアラート発報値以下の場合はアラート発報とする
                        if($nowTime >= $alert_time && $progress_value >= $alert_value){
                            // アラートを発報するので「true」をセットし、配列にメッセージをセット
                            $alert = true;
                            $alert_message_arr[] = $alert_message;
                        }
                    }
                }
            }
            // 変数の内容を配列にセット
            $data['progress_arr'][$key]['alert'] = $alert;
            $data['progress_arr'][$key]['alert_message'] = $alert_message_arr;
        }
        return $data;
    }
}