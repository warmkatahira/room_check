@vite(['resources/js/version_mgt/version_mgt.js'])

<x-app-layout>
    <x-page-header content="進捗履歴" />
    <!-- 検索条件 -->
    <x-progress-history.search :customers="$customers" :items="$items" />
    <!-- ページネーション -->
    <x-pagination :pages="$progress_histories" />
    <div class="">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">日付</th>
                    <th class="font-thin py-3 px-2">拠点名</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                    <th class="font-thin py-3 px-2">項目</th>
                    <th class="font-thin py-3 px-2">値</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($progress_histories as $progress_history)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">{{ CarbonImmutable::parse($progress_history->date)->isoFormat('Y年MM月DD日') }}</td>
                        <td class="py-1 px-2 border">{{ $progress_history->customer->base->base_name }}</td>
                        <td class="py-1 px-2 border">{{ $progress_history->customer->customer_name }}</td>
                        <td class="py-1 px-2 border">{{ $progress_history->item->item_name }}</td>
                        <td class="py-1 px-2 border text-right">{{ number_format($progress_history->progress_value) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>