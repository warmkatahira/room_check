@vite(['resources/js/alert_setting/alert_setting.js'])

<x-app-layout>
    <x-page-header content="項目マスタ詳細" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('alert_setting.update') }}" id="alert_setting_update_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.input type="text" name="alert_setting_name" label="設定名" :db="$alert_setting->alert_setting_name" />
        <x-master.select name="customer_code" label="荷主名" :forValue="$customers" forText="customer_name" :db="$alert_setting->customer_code" />
        <x-alert-setting.item-select :items="$items" :db="$alert_setting->item_code" />
        <x-alert-setting.alert-time-input :db="$alert_setting->alert_time" />
        <x-master.input type="text" name="alert_value" label="アラート発報値" :db="$alert_setting->alert_value" />
        <x-master.input type="text" name="alert_message" label="アラートメッセージ" :db="$alert_setting->alert_message" />
        <input type="hidden" name="alert_setting_id" value="{{ $alert_setting->alert_setting_id }}">
        <button type="button" id="alert_setting_update_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-edit la-lg mr-1"></i>更新</button>
    </form>
    <form method="POST" action="{{ route('alert_setting.delete') }}" id="alert_setting_delete_form" class="grid grid-cols-12 m-0">
        @csrf
        <input type="hidden" name="alert_setting_id" value="{{ $alert_setting->alert_setting_id }}">
        <button type="button" id="alert_setting_delete_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-red-600 mt-5"><i class="las la-trash-alt la-lg mr-1"></i>削除</button>
    </form>
</x-app-layout>