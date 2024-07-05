<x-app-layout>
    <x-page-header content="項目マスタ" />
    <div class="grid grid-cols-12 my-5">
        <a href="{{ route('item.create') }}" class="col-span-12 xl:col-span-1 py-3 text-center text-white text-sm bg-blue-600"><i class="las la-plus-square la-lg mr-1"></i>項目追加</a>
    </div>
    <div class="">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">項目コード</th>
                    <th class="font-thin py-3 px-2">項目名</th>
                    <th class="font-thin py-3 px-2">項目単位</th>
                    <th class="font-thin py-3 px-2">項目並び順</th>
                    <th class="font-thin py-3 px-2">進捗履歴追加</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($items as $item)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">
                            <a href="{{ route('item.update_index', ['item_code' => $item->item_code]) }}" class="text-blue-600">{{ $item->item_code }}</a>
                        </td>
                        <td class="py-1 px-2 border">{{ $item->item_name }}</td>
                        <td class="py-1 px-2 border">{{ $item->item_unit }}</td>
                        <td class="py-1 px-2 border text-right">{{ $item->item_sort_order }}</td>
                        <td class="py-1 px-2 border text-center">@if($item->is_progress_history_add == 1) 有効 @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>