@vite(['resources/js/customer/customer.js'])

<x-app-layout>
    <x-page-header content="荷主マスタ" />
    <div class="grid grid-cols-12 my-5">
        <a href="{{ route('customer.create') }}" class="col-span-12 xl:col-span-1 py-3 text-center text-white text-sm bg-blue-600"><i class="las la-plus-square la-lg mr-1"></i>荷主追加</a>
    </div>
    <x-customer.search :bases="$bases" />
    <div class="">
        <table class="text-xs block whitespace-nowrap">
            <thead>
                <tr class="text-center text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">拠点名</th>
                    <th class="font-thin py-3 px-2">荷主コード</th>
                    <th class="font-thin py-3 px-2">荷主分類</th>
                    <th class="font-thin py-3 px-2">荷主名</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($customers as $customer)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">{{ $customer->base->base_name }}</td>
                        <td class="py-1 px-2 border">
                            <a href="{{ route('customer.update_index', ['customer_code' => $customer->customer_code]) }}" class="text-blue-600">{{ $customer->customer_code }}</a>
                        </td>
                        <td class="py-1 px-2 border">{{ $customer->customer_category }}</td>
                        <td class="py-1 px-2 border">{{ $customer->customer_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>