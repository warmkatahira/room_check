@vite(['resources/js/progress_history/progress_history.js'])

<x-app-layout>
    <x-page-header content="進捗履歴" />
    <!-- 検索条件 -->
    <x-progress-history.search :bases="$bases" :items="$items" />
    <div class="mt-5">
        <a href="{{ route('progress_history.download') }}" class="text-sm text-center px-10 py-3 bg-theme-sub"><i class="las la-download la-lg mr-1"></i>ダウンロード</a>
    </div>
    <!-- ページネーション -->
    <x-pagination :pages="$progress_histories" />
    <div class="">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">日付</th>
                    <th class="font-thin py-3 px-2">時間</th>
                    <th class="font-thin py-3 px-2">拠点名</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                    <th class="font-thin py-3 px-2">項目名(単位)</th>
                    <th class="font-thin py-3 px-2">数量</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($progress_histories as $progress_history)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">{{ CarbonImmutable::parse($progress_history->date)->isoFormat('Y年MM月DD日(ddd)') }}</td>
                        <td class="py-1 px-2 border">{{ CarbonImmutable::parse($progress_history->created_at)->isoFormat('HH時mm分') }}</td>
                        <td class="py-1 px-2 border">{{ $progress_history->customer->base->base_name }}</td>
                        <td class="py-1 px-2 border">{{ $progress_history->customer->customer_name }}</td>
                        <td class="py-1 px-2 border">{{ $progress_history->item->item_name.'('.$progress_history->item->item_unit.')' }}</td>
                        <td class="py-1 px-2 border text-right">{{ number_format($progress_history->progress_value) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>