@vite(['resources/js/version_mgt/version_mgt.js'])

<x-app-layout>
    <x-page-header content="バージョン管理" />
    <x-version-mgt.search :bases="$bases" />
    <div class="">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">拠点名</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                    <th class="font-thin py-3 px-2">PC名</th>
                    <th class="font-thin py-3 px-2">システム名</th>
                    <th class="font-thin py-3 px-2">システムバージョン</th>
                    <th class="font-thin py-3 px-2">更新日時</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($system_version_managements as $system_version_management)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">{{ $system_version_management->customer->base->base_name }}</td>
                        <td class="py-1 px-2 border">{{ $system_version_management->customer->customer_name }}</td>
                        <td class="py-1 px-2 border">{{ $system_version_management->pc_name }}</td>
                        <td class="py-1 px-2 border">{{ $system_version_management->system_name }}</td>
                        <td class="py-1 px-2 border text-right">{{ $system_version_management->system_version }}</td>
                        <td class="py-1 px-2 border">{{ CarbonImmutable::parse($system_version_management->updated_at)->isoFormat('Y年MM月DD日 HH時mm分ss秒') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>