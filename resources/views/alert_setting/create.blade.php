@vite(['resources/js/alert_setting/alert_setting.js'])

<x-app-layout>
    <x-page-header content="アラート設定追加" />
    <!-- バリデーションエラー表示 -->
    <x-validation-error-msg />
    <form method="POST" action="{{ route('alert_setting.create') }}" id="alert_setting_create_form" class="grid grid-cols-12 m-0">
        @csrf
        <x-master.input type="text" name="alert_setting_name" label="設定名" :db="null" />
        <x-master.select name="customer_code" label="荷主名" :forValue="$customers" forText="customer_name" :db="null" />
        <x-alert-setting.item-select :items="$items" :db="null" />
        <x-alert-setting.alert-time-input :db="null" />
        <x-master.input type="text" name="alert_value" label="発報値" :db="null" />
        <x-master.input type="text" name="alert_message" label="メッセージ" :db="null" />
        <button type="button" id="alert_setting_create_enter" class="col-start-1 xl:col-start-1 col-span-12 xl:col-span-4 py-3 text-center text-white bg-blue-600 mt-5"><i class="las la-plus-square la-lg mr-1"></i>追加</button>
    </form>
</x-app-layout>