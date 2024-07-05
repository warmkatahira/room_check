<x-app-layout>
    <x-page-header content="アラート設定" />
    <div class="grid grid-cols-12 my-5">
        <a href="{{ route('alert_setting.create') }}" class="col-span-12 xl:col-span-1 py-3 text-center text-white text-sm bg-blue-600"><i class="las la-plus-square la-lg mr-1"></i>設定追加</a>
    </div>
    <div class="">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">設定名</th>
                    <th class="font-thin py-3 px-2">拠点名</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                    <th class="font-thin py-3 px-2">項目名(単位)</th>
                    <th class="font-thin py-3 px-2">アラート発報時刻</th>
                    <th class="font-thin py-3 px-2">アラート発報値</th>
                    <th class="font-thin py-3 px-2">アラートメッセージ</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($alert_settings as $alert_setting)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">
                            <a href="{{ route('alert_setting.update_index', ['alert_setting_id' => $alert_setting->alert_setting_id]) }}" class="text-blue-600">{{ $alert_setting->alert_setting_name }}</a>
                        </td>
                        <td class="py-1 px-2 border">{{ $alert_setting->customer->base->base_name }}</td>
                        <td class="py-1 px-2 border">{{ $alert_setting->customer->customer_name }}</td>
                        <td class="py-1 px-2 border">{{ $alert_setting->item->item_name.'('.$alert_setting->item->item_unit.')' }}</td>
                        <td class="py-1 px-2 border">{{ CarbonImmutable::parse($alert_setting->alert_time)->format('H:i') }}</td>
                        <td class="py-1 px-2 border">{{ $alert_setting->alert_value }}</td>
                        <td class="py-1 px-2 border">{{ $alert_setting->alert_message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>