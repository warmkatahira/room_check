<x-app-layout>
    <x-page-header content="荷主タグマスタ" />
    <div class="">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">荷主コード</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                    <th class="font-thin py-3 px-2">拠点名</th>
                    <th class="font-thin py-3 px-2">設定タグ</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($customers as $customer)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">
                            <a href="{{ route('customer_tag.update_index', ['customer_code' => $customer->customer_code]) }}" class="text-blue-600">{{ $customer->customer_code }}</a>
                        </td>
                        <td class="py-1 px-2 border">{{ $customer->customer_name }}</td>
                        <td class="py-1 px-2 border">{{ $customer->base->base_name }}</td>
                        <td class="py-1 px-2 border">
                            @foreach($customer->customer_tags as $customer_tag)
                                <span class="px-3 py-1 bg-theme-main rounded-md text-white">{{ $customer_tag->tag_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>