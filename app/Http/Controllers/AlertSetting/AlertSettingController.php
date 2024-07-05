<?php

namespace App\Http\Controllers\AlertSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\AlertSetting;
use App\Models\Customer;
use App\Models\Item;
// サービス
use App\Services\AlertSetting\AlertSettingService;
// リクエスト
use App\Http\Requests\AlertSettingCreateRequest;
use App\Http\Requests\AlertSettingUpdateRequest;

class AlertSettingController extends Controller
{
    public function index()
    {
        // アラート設定を全て取得
        $alert_settings = AlertSetting::getAll()->get();
        return view('alert_setting.index')->with([
            'alert_settings' => $alert_settings,
        ]);
    }

    public function create_index()
    {
        // 荷主を全て取得
        $customers = Customer::getAll()->get();
        // 項目を全て取得
        $items = Item::getAll()->get();
        return view('alert_setting.create')->with([
            'customers' => $customers,
            'items' => $items,
        ]);
    }

    public function create(AlertSettingCreateRequest $request)
    {
        // インスタンス化
        $AlertSettingService = new AlertSettingService;
        // アラート設定を追加
        $AlertSettingService->createAlertSetting($request);
        return redirect()->route('alert_setting.index')->with([
            'alert_type' => 'success',
            'alert_message' => 'アラート設定追加が完了しました。',
        ]);
    }

    public function update_index(Request $request)
    {
        // アラート設定を取得
        $alert_setting = AlertSetting::getSpecify($request->alert_setting_id)->first();
        // 荷主を全て取得
        $customers = Customer::getAll()->get();
        // 項目を全て取得
        $items = Item::getAll()->get();
        return view('alert_setting.update')->with([
            'alert_setting' => $alert_setting,
            'customers' => $customers,
            'items' => $items,
        ]);
    }

    public function update(AlertSettingUpdateRequest $request)
    {
        // インスタンス化
        $AlertSettingService = new AlertSettingService;
        // アラート設定を更新
        $AlertSettingService->updateAlertSetting($request);
        return redirect()->route('alert_setting.index')->with([
            'alert_type' => 'success',
            'alert_message' => 'アラート設定更新が完了しました。',
        ]);
    }

    public function delete(Request $request)
    {
        // インスタンス化
        $AlertSettingService = new AlertSettingService;
        // アラート設定を削除
        $AlertSettingService->deleteAlertSetting($request);
        return redirect()->route('alert_setting.index')->with([
            'alert_type' => 'success',
            'alert_message' => 'アラート設定削除が完了しました。',
        ]);
    }
}
